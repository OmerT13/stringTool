-   [Stringify](#stringify)
    -   [Audience](#audience)
    -   [Objectives](#objectives)
    -   [Contents](#contents)
    -   [How to Use](#how-to-use)
    -   [Proposed Testing](#proposed-testing)

Stringify
=========

Audience
--------

This tool has been developed in response to a challenge to assess my CLI skills, and its requirements have been detailed in a Technical Assessment document.

Objectives
----------

As mentioned in the Technical Assessment document, we need to create a CLI tool that takes a string as an input and outputs:

-   String in uppercase format
-   String alternating between uppercase and lowercase formats
-   `CSV created!` along with a CSV file that treats each character in the input as its own column

### Additional Inclusions

While the assessment did not explicitly require it, I took the liberty to do three additional tasks:

1.  Create a second CLI tool that extends the required tool (in order to prove extendability)
2.  Create two units tests, one for each CLI tool (in order to prove the code can respond to unit-testing)
3.  Create a simple shell script to run both unit tests

### Additional Inclusions Objectives

The objectives of the additional inclusions aim to address expectations of the assessment that were not included in the expected output, namely the requirement that the project is **unit-testable** and **extendible**.

1.  **Second CLI tool**

-   Uses the main class to output:

    -   String in uppercase format
    -   String alternating between uppercase and lowercase formats
-   It uses the main class along with its own properties to output:

    -   `CSV created!` along with a differently-named CSV file similar to that of the main class but with a different delimiter (main class uses `,`, this class uses `;`)
-   Finally, it has its own features that outputs:

    -   String in lowercase format
    -   A second version of the main class’s alternating cases string
        -   The main difference is this version does not take non-alphabetical characters into consideration when alternating
    -   String where all lowercase characters are converted to uppercase, and uppercase characters are converted to lowercase

1.  **Unit Tests**
     The units tests have one main objective:

    -   Verify that both classes are running as expected against different kinds of inputs

2.  **Shell script**
     A simple tool to automatically run both test scripts. The output can in turn be recorded for auditing and verifications purposes.

Contents
--------

-   The `Stringify` class
    -   Responds to the three requirements stated in the Technical Assessment document
    -   Location:
        -   *stringTool \> app \> Console \> Commands \> `Stringify.php`*
-   The `StringifyExt` class
    -   Extends the `Stringify` class, using classes from `Stringify` as well as its own classes
    -   Location:
        -   *stringTool \> app \> Console \> Commands \> `StringifyExt.php`*
-   The `stringifyTest` class
    -   Performs 9 units tests on the `Stringify` class
    -   Location:
        -   *stringTool \> tests \> Unit \> `stringifyTest.php`*
-   The `stringifyExtTest` class
    -   Performs 9 units tests on the `StringifyExt` class
    -   Location:
        -   *stringTool \> tests \> Unit \> `stringifyExtTest.php`*
-   The `stringify` shell script
    -   Runs both unit tests
    -   Located directly on the root
        -   *stringTool \> `stringify.sh`*

How to Use
----------

### Setting up the environment

1.  Download the `stringTool.tar.bz2` file, attached with this email
2.  Place the file in the directory where you desire the tool to be placed
3.  Uncompress the file using the following command
    -   `tar -xvf stringTool.tar.bz2`

4.  The project directory will now be visible
5.  Make sure your CLI is inside the project
    -   The directory name is `stringTool`

### Running the `Stringify` tool

#### Input

There are three ways to run the tool:

1.  Type *php artisan stringify* and follow it up with the input string
    -   If inputting `Hello`, you can type:
        -   `php artisan stringify Hello`
            -   Note that this will only work if your string has no spaces

2.  Type *php artisan stringify* followed by the input string inside double quotes
    -   If inputting `Hello`, you can type:
        -   `php artisan stringify "Hello"`

3.  Type *php artisan stringify* only
    -   You will be then prompted to give your input
        -   If inputting `Hello`, you can type:
            -   `php artisan stringify`
        -   Wait until you see the following prompt:
            -   `Please Input a String:`
        -   Respond with your input string:
            -   `Hello`

##### Note: Assuming permissions are available, you can pass this command with a second argument that will allow the CSV file to be created in a different directory. One of the unit test scenarios attempts to do so.

#### Output

Regardless of which way you have used, the output will be the same. Assuming you’ve used `Hello` as an input, your output would look like:

> HELLO
>  hElLO
>  CSV created!

-   Do note:
    -   You must press enter after each line of command
    -   The CSV file will be located in the root directory, and is named after the class (*/stringTool/Stringify.csv*)

### Running the `StringifyExt` tool

#### Input

The StringifyExt tool runs exactly the same way as Stringify, with one difference
 -Replace all instances of `stringify` with `stringifyExt`

##### Note

Just like `Stringify`, you can pass this command with a second argument that will allow the CSV file to be created in a different directory. Again, one of the unit test scenarios attempts to do so.

#### Output

Not unlike like `Stringify`, the output would be the same regardless of the way you input the data. Assuming you also used `Hello` as your input, this is how your output would look like:

> HELLO
>  hElLo
>  CSV created!
>  hElLo
>  hello
>  hELLO

-   Do note
    -   The CSV file will be named after the class (*/stringTool/StringifyExt.csv*)

### Limitations of Both Tools

Due to the nature of the tools’ objectives and how CSV files work, there are certain limitations to their use. Input strings will be rejected if

1.  They have no alphabetical characters
2.  Include the delimiting character of the CSV file
    -   The delimiting character in `Stringify` is the comma, `,`
    -   The delimiting character in `StringifyExt` is the semicolon, `;`
    -   Furthermore, the CSV file in particular will fail to create if the required permissions are not present.

### Performing Unit Testing

The unit tests aim to try different scenarios, using a mixture of:

-   Passing the input string as an argument, or waiting to be prompted
-   Passing strings that do not include alphabetical characters
-   Passing strings that include the CSV delimeter
-   Attempting to save the CSV in scenarios where it’s not permissible

Making sure your CLI is still inside the project, you will simply need to run the `stringify.sh` file, which will in turn automatically run both test scripts. Depending on the CLI you are using, you can do so using *one* of the following:

-   `sh stringify.sh`
    -   We will be using this for the remainder of the documentation
-   `./stringify.sh`
    -   You can continue following the documentation using this command if your CLI allows you

Proposed Testing
----------------

These are the steps I have used to verify the code. You can verify by looking at the `out.txt` file inside the `stringTool` directory.
 Do feel free to let me know if you have further suggestions .

1.  Decompress the attached file
    -   `tar -xvf stringTool.tar.bz2`

2.  Go into the `stringTool` directory
    -   `cd stringTool\`

3.  Run the `stringify.sh` script and output it to `out.txt`
    -   `sh stringify.sh > out.txt`

4.  View the outputted file
    -   `cat out.txt`

5.  Verify that all tests have passed
    -   18 in total, 9 for each tool


