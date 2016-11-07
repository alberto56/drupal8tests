9 ways to test your Drupal 8 module
=====

This is a Drupal module which showcases how to run different sorts of tests
on your code.

The module itself checks whether a year is a leap year or not, and tracks
how many times each year has been checked.

Prerequisites
-----

 * Docker (latest version).

Installation
-----

Make sure you have the latest version of Docker, and run:

    ./scripts/create.sh

Then follow instructions on screen.

Module usage
-----

Visit `/drupal8tests` and fill in the form a number of times. The system will
tell you if the year you are checking is a leap year or not, and how many
times that year was checked.

Running the entire test suite
-----

    ./scripts/tests.sh

Make it fast
-----

Keeping your unit tests under 30 seconds, and your entire test suite under
a few minutes, will

Use CI
Review code
BrowserTestBase
WebTestBase
KernelTestBase
UnitTestBase
Behat, Mink, PhantomJs
AVA
Coverage
Lint
