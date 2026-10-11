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
 * Spanish language pack for Enrol notify.
 *
 * @package    local_enrolnotify
 * @category   string
 * @copyright  2025 Studio LXD <hello@studiolxd.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'Notificación de matrícula';

// Message provider names.
$string['messageprovider:enrolment_confirmation'] = 'Confirmación de matrícula para estudiantes';
$string['messageprovider:enrolment_notification'] = 'Notificación de nueva matrícula para el personal';

// Settings.
$string['settings_studentheading'] = 'Notificaciones al estudiante';
$string['settings_staffheading'] = 'Notificaciones al personal';
$string['settings_notify_student'] = 'Habilitar notificación al estudiante';
$string['settings_notify_student_desc'] = 'Enviar una notificación de confirmación de matrícula al estudiante cuando se matricula en un curso.';
$string['settings_notify_admins'] = 'Notificar a los administradores';
$string['settings_notify_admins_desc'] = 'Enviar una notificación a todos los administradores del sitio cuando un estudiante se matricula en un curso.';
$string['settings_notify_managers'] = 'Notificar a los gestores';
$string['settings_notify_managers_desc'] = 'Enviar una notificación a los usuarios con el rol de Gestor en el contexto del curso cuando se matricula un nuevo estudiante.';
$string['settings_notify_editingteachers'] = 'Notificar a los profesores con edición';
$string['settings_notify_editingteachers_desc'] = 'Enviar una notificación a los profesores con permiso de edición del curso cuando se matricula un nuevo estudiante.';
$string['settings_notify_teachers'] = 'Notificar a los profesores sin edición';
$string['settings_notify_teachers_desc'] = 'Enviar una notificación a los profesores sin edición del curso cuando se matricula un nuevo estudiante.';

// Email subjects and bodies.
$string['emailsubject_student'] = 'Confirmación de matrícula en {$a->coursename}';
$string['emailbody_student'] = 'Hola, {$a->fullname}:

Hemos recibido correctamente tu pago y tu matrícula en el curso {$a->coursename}.

Puedes acceder al curso desde el siguiente enlace:
{$a->courseurl}';

$string['emailbody_student_html'] = '<p>Hola, {$a->fullname}:</p>
<p>Hemos recibido correctamente tu pago y tu matrícula en el curso <strong>{$a->coursename}</strong>.</p>
<p>Puedes acceder al curso desde el siguiente enlace:<br>
<a href="{$a->courseurl}">{$a->courseurl}</a></p>';

$string['emailsubject_support'] = 'Nuevo alumno matriculado en {$a->coursename}';
$string['emailbody_support'] = 'Se ha matriculado un nuevo alumno mediante pago en el curso "{$a->coursename}".

Nombre: {$a->fullname}
Correo: {$a->email}

Enlace al curso:
{$a->courseurl}';

$string['emailbody_support_html'] = '<p>Se ha matriculado un nuevo alumno mediante pago en el curso <strong>{$a->coursename}</strong>.</p>
<p>Nombre: {$a->fullname}<br>
Correo: {$a->email}</p>
<p>Enlace al curso:<br>
<a href="{$a->courseurl}">{$a->courseurl}</a></p>';
