# Challenge 039: Efficient Scientific Notation

## Install

* `composer install`

## Usage

    console version 1.0.0
    
    Usage:
      command [options] [arguments]
    
    Options:
      -h, --help            Display this help message
      -q, --quiet           Do not output any message
      -V, --version         Display this application version
          --ansi            Force ANSI output
          --no-ansi         Disable ANSI output
      -n, --no-interaction  Do not ask any interactive question
      -v|vv|vvv, --verbose  Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
    
    Available commands:
      help                               Displays help for a command
      list                               Lists commands
     app
      app:convert:decimal:to:scientific  Convert decimal number to scientific notation format
      app:convert:number:to:shortest     Convert number to shortest possible format
      app:convert:scientific:to:decimal  Convert scientific notation to decimal format
      
### app:convert:decimal:to:scientific

    Usage:
      app:convert:decimal:to:scientific -- <number>
    
    Arguments:
      number                Decimal value to convert
    
    Options:
      -h, --help            Display this help message
      -q, --quiet           Do not output any message
      -V, --version         Display this application version
          --ansi            Force ANSI output
          --no-ansi         Disable ANSI output
      -n, --no-interaction  Do not ask any interactive question
      -v|vv|vvv, --verbose  Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
    
    Help:
     Convert decimal number to scientific notation format
     
### app:convert:scientific:to:decimal

    Usage:
      app:convert:scientific:to:decimal -- <number>
    
    Arguments:
      number                Scientific value to convert
    
    Options:
      -h, --help            Display this help message
      -q, --quiet           Do not output any message
      -V, --version         Display this application version
          --ansi            Force ANSI output
          --no-ansi         Disable ANSI output
      -n, --no-interaction  Do not ask any interactive question
      -v|vv|vvv, --verbose  Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
    
    Help:
     Convert scientific notation to decimal format
     
### app:convert:number:to:shortest

    Usage:
      app:convert:number:to:shortest -- <number>
    
    Arguments:
      number                Numeric value to convert
    
    Options:
      -h, --help            Display this help message
      -q, --quiet           Do not output any message
      -V, --version         Display this application version
          --ansi            Force ANSI output
          --no-ansi         Disable ANSI output
      -n, --no-interaction  Do not ask any interactive question
      -v|vv|vvv, --verbose  Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
    
    Help:
     Convert number to shortest possible format
     
## Tests

* `bin/behat`

## Coverage

Code coverage gets generated in the build directory automatically by the behat test suites. The coverage report can be
viewed by opening `/build/coverage/html/index.html` in your browser.
