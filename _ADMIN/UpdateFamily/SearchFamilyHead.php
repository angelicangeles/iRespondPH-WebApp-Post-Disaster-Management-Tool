<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
$username = "";
$password = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = htmlspecialchars($_REQUEST['AdminUsername']);
    $password = htmlspecialchars($_REQUEST['AdminPassword']);
}
?>
<html>
    <head>

        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
        <link rel ="stylesheet" type="text/css" href ="../../lib/css/style.css">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
        
        <title>Search Family Head</title>
        <link rel='icon' type="png/icon" href='../../resources/images/logo/icon.png'>
    </head>
    <body>
        <div class="container" id="wrap">
            <div id="formContent">
                <h4> <legend>Search Family Head</legend></h4>
                <form action="Add_DeleteFamilyMembers.php" method="POST">

                    <input type="text" name="FirstName" placeholder='First Name' data-pattern='textOnly' required/>
                    <input type="text" name="MiddleName" placeholder='Middle Name' data-pattern='textOnly' required/>
                    <input type="text" name="LastName" placeholder='Last Name' data-pattern='textOnly' required/>
                    <input type="text" name="suffix" placeholder='suffix  (if applicable)' data-pattern='textOnly'/>
                    <input type="hidden" name="AdminUsername" value="<?php echo $username; ?>"/>
                    <input type="hidden" name="AdminPassword" value="<?php echo $password; ?>"/>
                    <input type="submit" value="SUBMIT" />
                </form>
                <form action="../adminMenu.php" method="POST">
                    <input type="hidden" name="AdminUsername" value="<?php echo $username; ?>"/>
                    <input type="hidden" name="AdminPassword" value="<?php echo $password; ?>"/>
                    <input type="submit" value="RETURN TO MAIN MENU"/>
                </form>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function() {
                updateInputPattern();
            });

            function updateInputPattern() {
                const specKey = ['Escape', 'AudioVolumeMute', 'AudioVolumeUp', 'AudioVolumeDown', 'Meta', 'Backspace', 'Delete', 'Shift', 'Tab', 'CapsLock', 'Shift', 'Control', 'Alt', 'ArrowRight', 'ArrowLeft', 'ArrowUp', 'ArrowDown', 'Enter', 'F1', 'F2', 'F3', 'F4', 'F5', 'F6', 'F7', 'F8', 'F9', 'F10', 'F11', 'F12', 'Home', 'End', 'PageUp', 'PageDown'];
                const textOnly = /[A-Za-z\.\s]+/g;
                const numberOnly = /[\d]+/g;
                const specChar = /[\\\^\$\.\|\?\*\+\(\)\[\]\{\}/!@#%&-_=:;'"<,>~`]+/g;
                const allChar = /.+/g;
                // FOR TEXTS ONLY
                $("[data-pattern*='textOnly']").on('keydown', function (event) {
                    let tmp = "";
                    if (!textOnly.test(event.key) && !specKey.includes(event.key)) {
                        event.preventDefault();
                        tmp = ("Prevented: " + event.key);
                    }
                    tmp = (event.key);
                    tmp = ("textOnly\nPattern Match: " + textOnly.test(event.key) + "\nisSpecKey: " + specKey.includes(event.key) + "\neventKey: " + event.key + "\ntextOnly var: " + textOnly);
                });
                // FOR NUMBERS ONLY
                $("[data-pattern*='numberOnly']").on('keydown', function (event) {
                    // console.log(event.key);
                    let tmp = "";
                    if ($(this).attr('type') == 'tel') {
                        if (!numberOnly.test(event.key) && event.key != "+" && !specKey.includes(event.key)) {
                            event.preventDefault();
                            tmp = ("Prevented: " + event.key);
                        }
                    } else {
                        if (!numberOnly.test(event.key) && !specKey.includes(event.key)) {
                            event.preventDefault();
                            tmp = ("Prevented: " + event.key);
                        }
                    }
                    tmp = (event.key);
                    tmp = ("numberOnly\nPattern Match: " + numberOnly.test(event.key) + "\nisSpecKey: " + specKey.includes(event.key) + "\neventKey: " + event.key + "\nnumberOnly var: " + numberOnly);
                });
                let currentPattern = $("[data-pattern*='numberOnly']").attr('pattern');
                currentPattern = currentPattern + "";
                // console.log(currentPattern);
                // try {console.log(!~$("[data-pattern*='numberOnly']").attr('pattern').indexOf("[A-Za-z\\.\\s]+"));} catch (exception) {}
                if (currentPattern.indexOf("undefined") >= 0) {
                    // FOR NUMBERS
                    if ($("[data-pattern*='numberOnly']").attr('type') == 'tel') {
                        $("[data-pattern*='numberOnly']").attr('pattern', "^+[\\d]+");  // IF TYPE IS CONTACT
                    } else {
                        $("[data-pattern*='numberOnly']").attr('pattern', "[\\d]+");    // IF TYPE ISN'T CONTACT
                    }
                    // FOR TEXTS
                    $("[data-pattern*='textOnly']").attr('pattern', "[A-Za-z\\.\\s]+");
                    // FOR SPECIAL CHARACTERS
                    $("[data-pattern*='specChar']").attr('pattern', "[\\\\\^\\$\\.\\|\\?\\*\\+\\(\\)\\[\\]\\{\\}/!@#%&-_=:;'\"<,>~`]+");
                    // FOR ALL CHARACTERS
                    $("[data-pattern='allChar']").attr('pattern', ".{" + $("[data-pattern='allChar']").attr("pattern-min") + "," + $("[data-pattern='allChar']").attr("pattern-max") + "}");
                } else {
                    // FOR NUMBERS
                    if ($("[data-pattern*='numberOnly']").attr('pattern').indexOf("[\\d]+") >= 0)
                        $("[data-pattern*='numberOnly']").attr('pattern', $("[data-pattern*='numberOnly']").attr('pattern') + "[\\d]+");
                    // FOR TEXTS
                    if ($("[data-pattern*='numberOnly']").attr('pattern').indexOf("[A-Za-z\\.\\s]+") >= 0)
                        $("[data-pattern*='textOnly']").attr('pattern', $("[data-pattern*='textOnly']").attr('pattern') + "[A-Za-z\\.\\s]+");
                    // FOR SPECIAL CHARACTERS
                    if ($("[data-pattern*='numberOnly']").attr('pattern').indexOf("[\\\\\^\\$\\.\\|\\?\\*\\+\\(\\)\\[\\]\\{\\}/!@#%&-_=:;'\"<,>~`]+") >= 0)
                        $("[data-pattern*='specChar']").attr('pattern', $("[data-pattern*='specChar']").attr('pattern') + "[\\\\\^\\$\\.\\|\\?\\*\\+\\(\\)\\[\\]\\{\\}/!@#%&-_=:;'\"<,>~`]+");
                    // FOR ALL CHARACTERS
                    if ($("[data-pattern*='numberOnly']").attr('pattern').indexOf(".{" + $("[data-pattern='allChar']").attr("pattern-min") + "," + $("[data-pattern='allChar']").attr("pattern-max") + "}") >= 0)
                        $("[data-pattern='allChar']").attr('pattern', ".{" + $("[data-pattern='allChar']").attr("pattern-min") + "," + $("[data-pattern='allChar']").attr("pattern-max") + "}");
                }
                /* SPECIAL CASE: If the input is the suffix
                 * If the element is focused, it will add the 'required' attribute.
                 * If it is unfocused, it will then remove the 'required' attribute.
                 * REASON:
                 * Adding the 'required' attribute allows the 'pattern' attribute to work;
                 * but at the same time, this will require the user to provide a value. Suffix is
                 * an optional value in people's name thus, the code below. If focused, the user will
                 * be forced to follow the pattern but will not allow the form to be submitted when it is blank.
                 * If it is unfocused after being traversed or something, it will remove the 'required' tag
                 * which would render the 'pattern' attribute useless, but will allow the form to submit the
                 * value despite being blank.
                 */
                $("[name='suffix']").focus(function () {
                    $(this).attr('required', 'required');
                });
                $("[name='suffix']").focusout(function () {
                    $(this).removeAttr('required');
                });
            }
        </script>
    </body>
</html>
