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
 * English language pack for Enrol notify.
 *
 * @package    local_enrolnotify
 * @category   string
 * @copyright  2025 Studio LXD <hello@studiolxd.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'Enrol notify';

// Message provider names.
$string['messageprovider:enrolment_confirmation'] = 'Enrolment confirmation for students';
$string['messageprovider:enrolment_notification'] = 'New enrolment notification for staff';

// Settings.
$string['settings_studentheading'] = 'Student notifications';
$string['settings_staffheading'] = 'Staff notifications';
$string['settings_notify_student'] = 'Enable student notification';
$string['settings_notify_student_desc'] = 'Send an enrolment confirmation notification to the student when they are enrolled in a course.';
$string['settings_notify_admins'] = 'Notify administrators';
$string['settings_notify_admins_desc'] = 'Send a notification to all site administrators when a student is enrolled in a course.';
$string['settings_notify_managers'] = 'Notify managers';
$string['settings_notify_managers_desc'] = 'Send a notification to users with the Manager role in the course context when a student is enrolled.';
$string['settings_notify_editingteachers'] = 'Notify editing teachers';
$string['settings_notify_editingteachers_desc'] = 'Send a notification to editing teachers enrolled in the course when a new student is enrolled.';
$string['settings_notify_teachers'] = 'Notify teachers';
$string['settings_notify_teachers_desc'] = 'Send a notification to non-editing teachers enrolled in the course when a new student is enrolled.';

// Email subjects and bodies.
$string['emailsubject_student'] = 'Your enrolment in {$a->coursename} is confirmed';
$string['emailbody_student'] = 'Hi {$a->fullname},

We have received your payment and your enrolment in the course "{$a->coursename}" is now confirmed.

You can access the course using the following link:
{$a->courseurl}';

$string['emailbody_student_html'] = '<p>Hi {$a->fullname},</p>
<p>We have received your payment and your enrolment in the course <strong>{$a->coursename}</strong> is now confirmed.</p>
<p>You can access the course using the following link:<br>
<a href="{$a->courseurl}">{$a->courseurl}</a></p>';

$string['emailsubject_support'] = 'New student enrolled in {$a->coursename}';
$string['emailbody_support'] = 'A new student has enrolled via payment in the course "{$a->coursename}".

Name: {$a->fullname}
Email: {$a->email}

Course link:
{$a->courseurl}';

$string['emailbody_support_html'] = '<p>A new student has enrolled via payment in the course <strong>{$a->coursename}</strong>.</p>
<p>Name: {$a->fullname}<br>
Email: {$a->email}</p>
<p>Course link:<br>
<a href="{$a->courseurl}">{$a->courseurl}</a></p>';
