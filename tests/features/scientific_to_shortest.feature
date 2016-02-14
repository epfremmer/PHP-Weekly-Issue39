Feature: Scientific notation number to shortest notation

  Scientific notation numbers can be converted to the shortest possible format using the
  app:convert:number:to:shortest console command

  Scenario: I can run the number to shortest command with a scientific number
    Given I have arguments:
      | key    | value   |
      | number | 1x10^+2 |
    When I run the "app:convert:number:to:shortest" command
    Then I should not get any errors

  Scenario Outline: Valid scientific notations get converted to shortest notation
    Given I have the numeric value "<input>"
    When I run the "app:convert:number:to:shortest" command
    Then I should not get any errors
    And the response should equal "<output>"
    Examples:
      | input       | output    |
      | 1x10^0      | 1         |
      | 2x10^1      | 20        |
      | 3x10^6      | 3x10^6    |
      | 4x10^5      | 400000    |
      | 8.093x10^-3 | 0.008093  |
      | 7.835x10^-3 | 0.007835  |
      | 3x10^-6     | 3x10^-6   |
      | 6.5x10^-7   | 6.5x10^-7 |
      | 0x10^0      | 0         |
