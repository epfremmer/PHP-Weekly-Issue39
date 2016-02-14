Feature: Decimal numbers to scientific notation

  Decimal numbers can be converted to scientific notation using the
  app:convert:decimal:to:scientific console command

  Scenario: I can run the decimal to scientific command
    Given I have arguments:
      | key    | value |
      | number | 100   |
    When I run the "app:convert:decimal:to:scientific" command
    Then I should not get any errors

  Scenario: Leading zeros on numbers greater than 1 do not affect the conversion
    Given I have the numeric value "000100"
    When I run the "app:convert:decimal:to:scientific" command
    Then I should not get any errors
    And the response should equal "1x10^2"

  Scenario: Trailing zeros on numbers less than 1 do not affect the conversion
    Given I have the numeric value "0.00100"
    When I run the "app:convert:decimal:to:scientific" command
    Then I should not get any errors
    And the response should equal "1x10^-3"

  Scenario: Unnecessary whitespace does not affect the conversion
    Given I have the numeric value "  0 . 00100  "
    When I run the "app:convert:decimal:to:scientific" command
    Then I should not get any errors
    And the response should equal "1x10^-3"

  Scenario Outline: Valid decimal numbers get converted to correct notation
    Given I have the numeric value "<input>"
    When I run the "app:convert:decimal:to:scientific" command
    Then I should not get any errors
    And the response should equal "<output>"
    Examples:
      | input             | output      |
      | 1                 | 1x10^0      |
      | 20                | 2x10^1      |
      | 3000000           | 3x10^6      |
      | 400000            | 4x10^5      |
      | 0.008093          | 8.093x10^-3 |
      | 0.007835000000000 | 7.835x10^-3 |
      | 0.000003000000    | 3x10^-6     |
      | 0.00000065        | 6.5x10^-7   |
      | 0                 | 0x10^0      |
      | 0.0               | 0x10^0      |

  Scenario Outline: Negative decimal numbers get converted to correct notation
    Given I have the numeric value "<input>"
    When I run the "app:convert:decimal:to:scientific" command
    Then I should not get any errors
    And the response should equal "<output>"
    Examples:
      | input              | output       |
      | -1                 | -1x10^0      |
      | -20                | -2x10^1      |
      | -3000000           | -3x10^6      |
      | -400000            | -4x10^5      |
      | -0.008093          | -8.093x10^-3 |
      | -0.007835000000000 | -7.835x10^-3 |
      | -0.000003000000    | -3x10^-6     |
      | -0.00000065        | -6.5x10^-7   |
      | -0                 | -0x10^0      |
      | -0.0               | -0x10^0      |

  Scenario Outline: Long numbers are converted without loosing precision
    Given I have the numeric value "<input>"
    When I run the "app:convert:decimal:to:scientific" command
    Then I should not get any errors
    And the response should equal "<output>"
    Examples:
      | input                                                                             | output                                                                                  |
      | 30000000000000000000000000000000000000000000000000000000                          | 3x10^55                                                                                 |
      | 3000000000000000000000000000000000000000000000000000000000000000000000000000001.1 | 3.0000000000000000000000000000000000000000000000000000000000000000000000000000011x10^78 |
      | 0.0000000000000000000000000000000000000000000000000000000000000000000000000000003 | 3x10^-79                                                                                |
      | 0.1000000000000000000000000000000000000000000000000000000000000000000000000000003 | 1.000000000000000000000000000000000000000000000000000000000000000000000000000003x10^-1  |

  Scenario Outline: Invalid decimal numbers throw an exception
    Given I have the numeric value "<input>"
    When I run the "app:convert:decimal:to:scientific" command
    Then I should get an error
    And the error message should contain "Expected number. Got"
    Examples:
      | input  |
      | abcd   |
      |        |
      | 123d   |
      | 2e1    |
      | 2x10^1 |
