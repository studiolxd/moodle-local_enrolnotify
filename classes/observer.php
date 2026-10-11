<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

namespace local_enrolnotify;

/**
 * Event observer for the enrol notify plugin.
 *
 * Listens to user_enrolment_created events and dispatches notifications
 * to the enrolled student and relevant staff members based on admin settings.
 *
 * @package    local_enrolnotify
 * @copyright  2025 Studio LXD <hello@studiolxd.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class observer {

    /**
     * Handle the user_enrolment_created event.
     *
     * Sends notifications to the enrolled student and/or staff members
     * depending on the plugin's admin settings.
     *
     * @param \core\event\user_enrolment_created $event The enrolment event.
     * @return void
     */
    public static function user_enrolled(\core\event\user_enrolment_created $event): void {
        global $DB;

        // Retrieve the enrolment and related records.
        $ue = $DB->get_record('user_enrolments', ['id' => $event->objectid], '*', MUST_EXIST);
        $enrol = $DB->get_record('enrol', ['id' => $ue->enrolid], '*', MUST_EXIST);
        $user = \core_user::get_user($ue->userid, '*', MUST_EXIST);
        $course = get_course($enrol->courseid);

        // Skip deleted or suspended users.
        if ($user->deleted || $user->suspended) {
            return;
        }

        $coursecontext = \core\context\course::instance($course->id);

        // Send enrolment confirmation to the student.
        if (get_config('local_enrolnotify', 'notify_student')) {
            notification_helper::send_student_confirmation($user, $course);
        }

        // Track notified user IDs to avoid duplicate notifications.
        $notified = [];

        // Notify site administrators.
        if (get_config('local_enrolnotify', 'notify_admins')) {
            $admins = get_admins();
            foreach ($admins as $admin) {
                if (!isset($notified[$admin->id])) {
                    notification_helper::send_staff_notification($admin, $user, $course);
                    $notified[$admin->id] = true;
                }
            }
        }

        // Notify managers in the course context (includes parent context assignments).
        if (get_config('local_enrolnotify', 'notify_managers')) {
            $managers = notification_helper::get_role_users_in_course('manager', $coursecontext);
            foreach ($managers as $manager) {
                if (!isset($notified[$manager->id])) {
                    notification_helper::send_staff_notification($manager, $user, $course);
                    $notified[$manager->id] = true;
                }
            }
        }

        // Notify editing teachers in the course.
        if (get_config('local_enrolnotify', 'notify_editingteachers')) {
            $editingteachers = notification_helper::get_role_users_in_course('editingteacher', $coursecontext);
            foreach ($editingteachers as $teacher) {
                if (!isset($notified[$teacher->id])) {
                    notification_helper::send_staff_notification($teacher, $user, $course);
                    $notified[$teacher->id] = true;
                }
            }
        }

        // Notify non-editing teachers in the course.
        if (get_config('local_enrolnotify', 'notify_teachers')) {
            $teachers = notification_helper::get_role_users_in_course('teacher', $coursecontext);
            foreach ($teachers as $teacher) {
                if (!isset($notified[$teacher->id])) {
                    notification_helper::send_staff_notification($teacher, $user, $course);
                    $notified[$teacher->id] = true;
                }
            }
        }
    }
}
