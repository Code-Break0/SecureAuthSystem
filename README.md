# SecureAuthSystem
A secure PHP login system made from scratch with protections against several common attacks

Check out the youtube playlist here: https://www.youtube.com/playlist?list=PLG5M8QIx5lkwT6ly5V34uLpX_5anpUEB3

Please note this code is not provided so that you can just copy and paste it (although there are no legal issues in doing so). It may not work out of the box for you. The intent behind posting the code is that you can follow along with the videos and refrence it if you need. Please do not spam the comment section of my videos with error messages if you are having issues implementing it. However, if you do find an issue with the ACTUAL CODE (not issues that only apply to your enviornment) please submit an issue to github.


### Features / Protections
- Login (protected against brute force/dictionary attacks)
- Sign Up
- password reset (done in a secure and friendly manner)
- Email Validation (ensure user has access to the email they used to make the account)
- CSRF protection for all features/forms
- Account Deletion 
- All features are protected from SQL Injection using PHP prepared statements
- XSS protection (see video for how to impliment when adding your own pages with untrusted data on them)
- All passwords are hashed so that even with access to the database attackers could not obtain users passwords (passwords are hashed and salted)

... Possibly more that I did not think of at the time of writing this

***Some features may not have been implemented yet***


### Hot to use
1. Download and install either MAMP/XAMPP (alternatively individually download php, mysql, and an apache server if you know what you are doing)
2. Ensure you are using an up to date version of PHP. I tested with version 8 but 7 should work however I have not tested it myself.
3. Copy and paste all files into the public directory
4. Modify config.php to match your environment and use case (may have to modify other files as well)
5. Start mysql and apache server services
6. Visit your website and test 
