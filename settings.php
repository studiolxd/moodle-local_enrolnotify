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

/**
 * Settings for Enrol notify.
 *
 * @package    local_enrolnotify
 * @copyright  2025 Studio LXD <hello@studiolxd.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    $settings = new admin_settingpage('local_enrolnotify', get_string('pluginname', 'local_enrolnotify'));

    // Student notifications heading.
    $settings->add(new admin_setting_heading(
        'local_enrolnotify/studentheading',
        get_string('settings_studentheading', 'local_enrolnotify'),
        ''
    ));

    // Enable student notification.
    $settings->add(new admin_setting_configcheckbox(
        'local_enrolnotify/notify_student',
        get_string('settings_notify_student', 'local_enrolnotify'),
        get_string('settings_notify_student_desc', 'local_enrolnotify'),
        1
    ));

    // Staff notifications heading.
    $settings->add(new admin_setting_heading(
        'local_enrolnotify/staffheading',
        get_string('settings_staffheading', 'local_enrolnotify'),
        ''
    ));

    // Notify administrators.
    $settings->add(new admin_setting_configcheckbox(
        'local_enrolnotify/notify_admins',
        get_string('settings_notify_admins', 'local_enrolnotify'),
        get_string('settings_notify_admins_desc', 'local_enrolnotify'),
        0
    ));

    // Notify managers.
    $settings->add(new admin_setting_configcheckbox(
        'local_enrolnotify/notify_managers',
        get_string('settings_notify_managers', 'local_enrolnotify'),
        get_string('settings_notify_managers_desc', 'local_enrolnotify'),
        0
    ));

    // Notify editing teachers.
    $settings->add(new admin_setting_configcheckbox(
        'local_enrolnotify/notify_editingteachers',
        get_string('settings_notify_editingteachers', 'local_enrolnotify'),
        get_string('settings_notify_editingteachers_desc', 'local_enrolnotify'),
        0
    ));

    // Notify non-editing teachers.
    $settings->add(new admin_setting_configcheckbox(
        'local_enrolnotify/notify_teachers',
        get_string('settings_notify_teachers', 'local_enrolnotify'),
        get_string('settings_notify_teachers_desc', 'local_enrolnotify'),
        0
    ));

    $ADMIN->add('localplugins', $settings);
}
