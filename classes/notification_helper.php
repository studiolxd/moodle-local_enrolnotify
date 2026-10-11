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
 * Helper class for sending enrolment notification messages.
 *
 * @package    local_enrolnotify
 * @copyright  2025 Studio LXD <hello@studiolxd.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class notification_helper {

    /**
     * Send enrolment confirmation to the student.
     *
     * @param \stdClass $user   The enrolled user (full user record).
     * @param \stdClass $course The course record.
     * @return void
     */
    public static function send_student_confirmation(\stdClass $user, \stdClass $course): void {
        global $SITE;

        $coursecontext = \core\context\course::instance($course->id);
        $courseurl = new \moodle_url('/course/view.php', ['id' => $course->id]);
        $coursename = format_string($course->fullname, true, ['context' => $coursecontext]);

        $a = (object) [
            'fullname'    => fullname($user),
            'coursename'  => $coursename,
            'courseurl'    => $courseurl->out(false),
            'sitefullname' => format_string($SITE->fullname),
        ];

        $subject = get_string('emailsubject_student', 'local_enrolnotify', $a);
        $bodyplain = get_string('emailbody_student', 'local_enrolnotify', $a);
        $bodyhtml = get_string('emailbody_student_html', 'local_enrolnotify', $a);

        $message = new \core\message\message();
        $message->component         = 'local_enrolnotify';
        $message->name              = 'enrolment_confirmation';
        $message->courseid          = $course->id;
        $message->userfrom          = \core_user::get_noreply_user();
        $message->userto            = $user;
        $message->subject           = $subject;
        $message->fullmessageformat = FORMAT_HTML;
        $message->fullmessage       = $bodyplain;
        $message->fullmessagehtml   = $bodyhtml;
        $message->smallmessage      = $subject;
        $message->notification      = 1;
        $message->contexturl        = $courseurl->out(false);
        $message->contexturlname    = $coursename;

        message_send($message);
    }

    /**
     * Send enrolment notification to a staff member.
     *
     * @param \stdClass $recipient The staff user to notify.
     * @param \stdClass $user      The newly enrolled student.
     * @param \stdClass $course    The course record.
     * @return void
     */
    public static function send_staff_notification(\stdClass $recipient, \stdClass $user, \stdClass $course): void {
        global $SITE;

        $coursecontext = \core\context\course::instance($course->id);
        $courseurl = new \moodle_url('/course/view.php', ['id' => $course->id]);
        $coursename = format_string($course->fullname, true, ['context' => $coursecontext]);

        $a = (object) [
            'fullname'     => fullname($user),
            'email'        => $user->email,
            'coursename'   => $coursename,
            'courseurl'     => $courseurl->out(false),
            'sitefullname' => format_string($SITE->fullname),
        ];

        $subject = get_string('emailsubject_support', 'local_enrolnotify', $a);
        $bodyplain = get_string('emailbody_support', 'local_enrolnotify', $a);
        $bodyhtml = get_string('emailbody_support_html', 'local_enrolnotify', $a);

        $message = new \core\message\message();
        $message->component         = 'local_enrolnotify';
        $message->name              = 'enrolment_notification';
        $message->courseid          = $course->id;
        $message->userfrom          = \core_user::get_noreply_user();
        $message->userto            = $recipient;
        $message->subject           = $subject;
        $message->fullmessageformat = FORMAT_HTML;
        $message->fullmessage       = $bodyplain;
        $message->fullmessagehtml   = $bodyhtml;
        $message->smallmessage      = $subject;
        $message->notification      = 1;
        $message->contexturl        = $courseurl->out(false);
        $message->contexturlname    = $coursename;

        message_send($message);
    }

    /**
     * Get users with a specific role shortname in a course context.
     *
     * Uses get_role_users() from core accesslib with parent context lookup
     * enabled, so roles assigned at category or system level are included.
     *
     * @param string                $roleshortname The role shortname (e.g. 'manager', 'editingteacher', 'teacher').
     * @param \core\context\course  $coursecontext  The course context.
     * @return array Array of user records.
     */
    public static function get_role_users_in_course(string $roleshortname, \core\context\course $coursecontext): array {
        global $DB;

        $roleid = $DB->get_field('role', 'id', ['shortname' => $roleshortname]);
        if (!$roleid) {
            return [];
        }

        return get_role_users($roleid, $coursecontext, true, 'u.*');
    }
}
