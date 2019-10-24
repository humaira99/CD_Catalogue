# CD_Catalogue
A front-end website displaying a CD Catalogue, linked to a database, implemented using MySQL, PHP, HTML, CSS, JavaScript

# List of Features 

### HTML
• Head : Included in the head tag is the title of the page that appears on the website tab, the link to the CSS style sheet and the javascript link . 
• Title : Title of the webpage in the browser tab . 
• Link : Links to the CSS style sheet . 
• Script : Used to include the javascript src . 
• Body : Body contains the rest of the webpage which is not the header/footer i.e. headings/form/table . 
• Headings : h1,h2 and h3 used to display different sized headings throughout the webpage . 
• Header : Included in the header is the navigation bar . 
• Nav : Nav used to organise the navigation bar in the header . 
• Unordered list : UL used for the navigation bar to separate links to pages . 
• Form : Form used for add/edit pages as well as the search box . 
• Input : Input type inside the form i.e. text/submit/button/hidden (to savevariables in the form without displaying them). Also used for validation e.g including “required” in to input tags which causes an pop up to prompt the user to enter input in forms if they try to leave it blank or “type=number” which ensures the field would only accept numeric input . 
• onclick : Used in delete input tags so when delete button is pressed, calls the delete function to delete the data . 
• onblur : Used in input so validation occurs as soon as user clicks out of the input field, instead of only validating when save is pressed . 
• Select/Option : Used in the form for dropdown menus when editing/adding to the database . 
• Table : th, td, tr used to organise data from the database in to a table to display on the webpage . 
• Footer : Footer at the bottom of the main pages . 
                
 ### CSS
• Styled using ID, tags and classes . 
• Used colour/padding/margins/list styles/borders/fonts . 
• Used :hover, so when user hovers over buttons/navigation bar/table rows, the text or background would change colour . 
• Used a transition so colour changes are gradual . 
• Used a class called “active” on the navigation bar so the active webpage is highlighted so the user knows which index they are on . 
NOTE: due to this ‘active’ feature, the navigation bar could not be included via link (for efficiency) on each file as it changed as per page. Therefore, the same code had to be copied and pasted on to each file . 
References: https://www.w3schools.com/css/css3_buttons.asp https://www.w3schools.com/css/css_navbar.asp

 ### Javascript
• Used javascript for form validation for edit/add pages . 
• Javascript included in the head of the file (inline) . 
• Made different functions for each input validation type, i.e. dropdown/alpha/alphanumeric/numeric/price/duration . 
• Functions contained an if statement for if the input was valid/invalid. If the input was invalid this would cause the field border to go red. If the invalid input is corrected, the border would change back to normal . 
• The functions were called “onblur” in the html input tags, with the parameter being the input id. This was so the fields would be validated as soon as the user clicks away from the input field. The main function to validate was also called when the user pressed save/submit . 
• Functions included regex for checking input against expected input types . 
• Time regex found online at: http://jjb.io/regex-for-24-hour-time/ . 
• Used alerts for when input is invalid, so the browser alerts the user to enter valid input . 
• Javascript used for deleting data . 
• confirm( ) used to show an alert which would carry out the function if “confirm” is pressed by the user . 
• window.location.href used to re-navigate user after pressing delete button . 
• JQuery/AJAX also used to hide the table headings when there are no search results found, using .hide( );  

### PHP
• Used PHP to connect to the database, using mysqli_connect( ); and to display, update, add and delete database information in the webpage . 
• Require used to include the file which connection to the database is made . 
• $_POST used to get form data - for when search is pressed and data inputted in to the edit/add forms . 
• Search bar made using https://www.youtube.com/watch?v=PBLuP2JZcEg as a guide . 
• When data fetched using mysqli_fetch_array( ), cdID/artID passed in to URL for edit and delete buttons so the correct data is deleted/displayed in the form when the buttons are pressed . 
• echo $row[‘name’] used to fill out table and form data . 
• mysqli_query( ) used to process sql statements in to the database . 
• header(“Location: ....”); used to re-navigate the user . 
• $_GET used to fetch the ID passed in to the URL for edit/delete . 
• PHP included in html input tags to display data fetched from the database . 
• Add form data in to the database using prepared statements to avoid SQL injections - using https://stackoverflow.com/questions/37367992/php- inserting-values-from-the-form-into-mysql as a guide . 
