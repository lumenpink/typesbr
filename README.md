[![TypesBR](https://github.com/lumenpink/typesbr/actions/workflows/github-actions.yml/badge.svg)](https://github.com/lumenpink/typesbr/actions/workflows/github-actions.yml)


# Lumenpink/Typesbr

Common types for Brazilian Documents and Numbers
(only CPF for now)


## Installation

Install it usingo composer

```bash
composer require lumenpink/typesbr
```

## Usage

```php
use Lumenpink/Typesbr/Cpf

# Create new CPF
$cpf = new Cpf('000.000.001-91')  // it accepts with or without mask or leading zeroes
                                  // it throwns an InvalidArgumentException if invalid

# Return only digits
$cpf->digits(); // returns 00000000191

# Or the formatted (masked) version
$Cpf->formated(); // returns 000.000.001-91

# Return the type of document
$Cpf->type(); // returns 'cpf'

# Use it as primitive type on a function
function foo (Cpf $cpf) {
    do_something_with_this_shining_new_and_valid_cpf($cpf)
}

```

## Testing

We love the [PEST Suite](https://pestphp.com) by Nuno Maduro

To ruyn the tests just type:
```bash
vendor/bin/pest
```

## Contributing

Pull requests are welcome. For major changes, please open an issue first
to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License

[MIT](https://choosealicense.com/licenses/mit/)