# Titter

So basically, the current Twitter frontend sucks. It's slow, ugly, and horrible. I was fine with using it until they started introducing shit like the piss verification mark, businesses with square profile pictures, etc. But I finally had it when they introduced Tweet view counts. It offsets the reply button, and even worse, breaks an extension that I used to download videos. So we're here. This is a recreation of the Twitter frontend used from 2014-2019. More specifically, 2017-2019, because it has the 2017+ design.

## NOTICE!

* I cannot guarantee whether you will be banned from Twitter for using this or not. Use at your own discretion.
* This project is VERY VERY early in development. There will be MANY missing and broken features.

## Requirements

titter requires at least **PHP 8.1**. You will also need the `intl` extension, as it is needed for emoji parsing. It comes with XAMPP, but it is disabled by default. You can enable it by uncommenting the line that reads `;extension=intl` in `C:\xampp\php\php.ini`.

## Want to contribute?

See [this document](CONTRIBUTE.md).

## Thank you!

* **[Taniko Yamamoto](https://github.com/YukisCoffee)** and the **[Rehike](https://github.com/Rehike/Rehike)** project for laying out the structure of frontends like this
* **[Aaron Parecki](https://github.com/aaronpk)** for writing the emoji parser titter uses for Twemoji
* **[Symfony](https://github.com/symfony)** for creating Twig, the templating engine titter uses