@format @format_learningmap
Feature: The standalone learningmap page respects course access
  In order to keep course pages restricted to authorised users
  As a student
  I need the standalone page to check enrolment and course visibility

  Background:
    Given the following config values are set as admin:
      | enrol_plugins_enabled | manual |
    And the following "users" exist:
      | username | firstname | lastname | email               |
      | student1 | Test      | Student  | student@example.com |
    And the following "courses" exist:
      | fullname        | shortname | format      | visible |
      | Enrolled course | C1        | learningmap | 1       |
      | Other course    | C2        | learningmap | 1       |
      | Hidden course   | C3        | learningmap | 0       |
    And the following "course enrolments" exist:
      | user     | course | role    |
      | student1 | C1     | student |
      | student1 | C3     | student |

  Scenario: An enrolled student sees the course heading
    When I am on the "C1" "format_learningmap > View" page logged in as "student1"
    Then the url should match "/course/format/learningmap/view[.]php[?]id=[0-9]+$"
    And "Enrolled course" "heading" should exist

  Scenario: A student cannot open a course without enrolment
    When I am on the "C2" "format_learningmap > View" page logged in as "student1"
    Then the url should match "/enrol/index[.]php[?]id=[0-9]+$"
    And I should see "You cannot enrol yourself in this course."

  Scenario: An enrolled student cannot open a hidden course
    When I am on the "C3" "format_learningmap > View" page logged in as "student1"
    Then I should see "This course is currently unavailable to students"
    And "Hidden course" "heading" should not exist
