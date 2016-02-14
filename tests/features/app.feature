Feature: Application exists

  Scenario: Application entry point exists
    Given I am in the "." path
    Then file "app/console" should exist
    And "app/console" file should contain:
      """
      #!/usr/bin/env php
      vendor/autoload.php
      """

  Scenario: Application is executable
    Given I am in the "." path
    Then file "app/console" should be executable

  Scenario: I can get application help
    When I run the "help" command
    Then I should not get any errors
    And I should get a response that contains "Usage:"
    And I should get a response that contains "Arguments:"
    And I should get a response that contains "Options:"
    And I should get a response that contains "Help:"

  Scenario: I can get a command listing
    When I run the "list" command
    Then I should not get any errors
    And I should get a response that contains "Usage:"
    And I should get a response that contains "Options:"
    And I should get a response that contains "Available commands:"
    And I should get a response that contains "app"
    And I should get a response that contains "app:convert:decimal:to:scientific"
    And I should get a response that contains "app:convert:number:to:shortest"
    And I should get a response that contains "app:convert:scientific:to:decimal"
