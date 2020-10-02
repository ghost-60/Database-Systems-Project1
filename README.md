# Database-Systems-Project1

Built a website for profiling Home and Auto Insurance for customers.

## Features

### General
-Session Variable is used to distinguish between different sessions for users. It's also responsible for maintaining database integrity. After a certain threshold of inactivity, the user is automatically logged out.
-All session variables are assigned using POST and are safely destroyed upon exiting the page.
-Passwords are encrypted using md5 encryption for security reasons.
-To prevent SQL injections, prepare statements have been used that auto checks for suspicious input data.
-Every user data is auto indexed to speed up queries and improve the overall accuracy for data retrieval.

### Customer
-Each customer can create an account using a unique email address. Multiple accounts can be created by the same user provided the email address is unique.
-Customers can register their homes and choose a new insurance plan or add the home to an existing insurance.
-The premium amount is calculated based on the parameters of the home insured which is additive incase of multiple homes. It also depends on the plan the user chooses.
-The longer the plan, the more lucrative the offer becomes.
-Customers can add and remove registered homes except for the homes which are already insured.
-Customers can freely cancel their insurance subscription anytime.
-To remove an insured home, the customer must first cancel the insurance plan for that home. 

### Invoices
-Invoices are generated on a monthly basis for each insurance. 
-Each invoice has a due date at the end of the month the invoice was generated. 
-After the due date has passed, the status becomes overdue and an interest is added per  month the invoice isn’t paid.
-After cancelling any insurance, the invoice for that month must still be paid as it's an advance payment model.

### Analytics
-Customers can see the graph detailing how much they are paying per month for each insurance. 
-A visualization for the most popular insurance plan is also shown.
-These features are also available for admin who is shown the data for all customers.


