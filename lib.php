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

function local_deletecourse_extend_settings_navigation($settingsnav, $context) {
    global $CFG , $PAGE;

    // Verifier que l'on est dans un contexte de cours
    if ($context == null || $context->contextlevel != CONTEXT_COURSE) {
        return;
    }

    // Verifier qu'il y a bien le menu "Administration du cours"
    if (null == ($courseadminnode = $settingsnav->get('courseadmin'))) {
        return;
    }

    //Verifier que l'utilisateur a bien le droit de supprimer un cours
    if (!has_capability('moodle/course:delete', context_course::instance($PAGE->course->id))) {
        return;
    }

    //Créer l'adresse qui permet de supprimer le cours
    $url = new moodle_url($CFG->wwwroot . '/course/delete.php', array('id' => $context->instanceid));

    //Ajouter une ligne au menu d'administration du cours
    $courseadminnode->add(get_string('pluginname','local_deletecourse'), $url,navigation_node::TYPE_SETTING, null, 'deletecourse'.$context->instanceid, new pix_icon('i/delete', ''));
}

