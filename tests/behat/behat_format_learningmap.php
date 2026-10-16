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
 * Behat navigation for the learningmap course format.
 *
 * @package    format_learningmap
 * @category   test
 * @copyright  2026 ISB Bayern
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../../../../lib/behat/behat_base.php');

/**
 * Resolve learningmap course format pages.
 *
 * @package    format_learningmap
 * @category   test
 * @copyright  2026 ISB Bayern
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class behat_format_learningmap extends behat_base {
    /**
     * Resolve the standalone view page using a course identifier.
     *
     * Recognised page types:
     * | Type | Identifier                        | Description                        |
     * | View | Course name, shortname or idnumber | The standalone course format page. |
     *
     * @param string $type Page type.
     * @param string $identifier Course name, shortname or idnumber.
     * @return moodle_url
     * @throws coding_exception If the page type is unknown or the course does not exist.
     */
    protected function resolve_page_instance_url(string $type, string $identifier): moodle_url {
        if (strtolower($type) !== 'view') {
            throw new coding_exception('Unknown learningmap page type: ' . $type);
        }

        $courseid = $this->get_course_id($identifier);
        if ($courseid === null) {
            throw new coding_exception('Unknown course: ' . $identifier);
        }

        return new moodle_url('/course/format/learningmap/view.php', ['id' => $courseid]);
    }
}
