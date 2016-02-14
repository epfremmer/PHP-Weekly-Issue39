Feature: Scientific notation number to decimal value

  Scientific notation numbers get converted to decimal format using the
  app:convert:scientific:to:decimal console command

  Scenario: I can run the scientific to decimal command
    Given I have arguments:
      | key    | value   |
      | number | 1x10^+2 |
    When I run the "app:convert:scientific:to:decimal" command
    Then I should not get any errors

  Scenario: Leading zeros on notations greater than 1 do not affect the conversion
    Given I have the numeric value "0001x10^2"
    When I run the "app:convert:scientific:to:decimal" command
    Then I should not get any errors
    And the response should equal "100"

  Scenario: Trailing zeros on notations less than 1 do not affect the conversion
    Given I have the numeric value "1.000x10^-3"
    When I run the "app:convert:scientific:to:decimal" command
    Then I should not get any errors
    And the response should equal "0.001"

  Scenario: Unnecessary whitespace does not affect the conversion
    Given I have the numeric value "  1.000 x 10 ^ -3  "
    When I run the "app:convert:scientific:to:decimal" command
    Then I should not get any errors
    And the response should equal "0.001"

  Scenario Outline: Valid scientific notations get converted to correct decimal value
    Given I have the numeric value "<input>"
    When I run the "app:convert:scientific:to:decimal" command
    Then I should not get any errors
    And the response should equal "<output>"
    Examples:
      | input       | output     |
      | 1x10^0      | 1          |
      | 2x10^1      | 20         |
      | 3x10^6      | 3000000    |
      | 4x10^5      | 400000     |
      | 8.093x10^-3 | 0.008093   |
      | 7.835x10^-3 | 0.007835   |
      | 3x10^-6     | 0.000003   |
      | 6.5x10^-7   | 0.00000065 |
      | 0x10^0      | 0          |

  Scenario Outline: Negative scientific notations get converted to correct decimal value
    Given I have the numeric value "<input>"
    When I run the "app:convert:scientific:to:decimal" command
    Then I should not get any errors
    And the response should equal "<output>"
    Examples:
      | input        | output      |
      | -1x10^0      | -1          |
      | -2x10^1      | -20         |
      | -3x10^6      | -3000000    |
      | -4x10^5      | -400000     |
      | -8.093x10^-3 | -0.008093   |
      | -7.835x10^-3 | -0.007835   |
      | -3x10^-6     | -0.000003   |
      | -6.5x10^-7   | -0.00000065 |
      | -0x10^0      | -0          |

  Scenario Outline: Long notations are converted without loosing precision
    Given I have the numeric value "<input>"
    When I run the "app:convert:scientific:to:decimal" command
    Then I should not get any errors
    And the response should equal "<output>"
    Examples:
      | input                                                                                   | output                                                                            |
      | 3x10^55                                                                                 | 30000000000000000000000000000000000000000000000000000000                          |
      | 3.0000000000000000000000000000000000000000000000000000000000000000000000000000011x10^78 | 3000000000000000000000000000000000000000000000000000000000000000000000000000001.1 |
      | 3x10^-79                                                                                | 0.0000000000000000000000000000000000000000000000000000000000000000000000000000003 |
      | 1.000000000000000000000000000000000000000000000000000000000000000000000000000003x10^-1  | 0.1000000000000000000000000000000000000000000000000000000000000000000000000000003 |

  Scenario Outline: Invalid scientific notations throw an exception
    Given I have the numeric value "<input>"
    When I run the "app:convert:scientific:to:decimal" command
    Then I should get an error
    And the error message should contain "Expected scientific notation. Got"
    Examples:
      | input  |
      | abcd   |
      |        |
      | 123d   |
      | 2e1    |
      | 20     |
