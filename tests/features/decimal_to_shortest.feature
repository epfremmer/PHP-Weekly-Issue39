Feature: Decimal number to shortest notation

  Decimal numbers can be converted to the shortest possible format using the
  app:convert:number:to:shortest console command

  Scenario: I can run the number to shortest command with a decimal number
    Given I have arguments:
      | key    | value |
      | number | 100   |
    When I run the "app:convert:number:to:shortest" command
    Then I should not get any errors

  Scenario Outline: Valid decimal numbers get converted to shortest notation
    Given I have the numeric value "<input>"
    When I run the "app:convert:number:to:shortest" command
    Then I should not get any errors
    And the response should equal "<output>"
    Examples:
      | input             | output    |
      | 1                 | 1         |
      | 20                | 20        |
      | 3000000           | 3x10^6    |
      | 400000            | 400000    |
      | 0.008093          | 0.008093  |
      | 0.007835000000000 | 0.007835  |
      | 0.000003000000    | 3x10^-6   |
      | 0.00000065        | 6.5x10^-7 |
      | 0                 | 0         |
