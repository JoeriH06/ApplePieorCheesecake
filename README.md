# forecastbaking

# Test Plan

## PDF file with whole plan
![here](public/pdfplan/testdock.pdf)

## User Stories
1. **Data Classification**
   - Happy Path: The data is classified correctly based on the given price ranges.
   - Unhappy Path: The data classification fails due to incorrect data format.

2. **User Registration**
   - Happy Path: A user successfully registers with valid data.
   - Unhappy Path: Registration fails with invalid data.

3. **User Login**
   - Happy Path: A user successfully logs in with valid credentials.
   - Unhappy Path: Login fails with invalid credentials.

4. **Recipe Index View**
   - Happy Path: Authenticated user views the list of recipes.
   - Unhappy Path: Unauthenticated user is redirected to the login page.

5. **Recipe Show View**
   - Happy Path: Authenticated user views a specific recipe.
   - Unhappy Path: Unauthenticated user is redirected to the login page or the recipe does not exist.

## Tests
### Unit Tests
- **Recipe Index View**:
  - Test that the recipe index view is displayed correctly for authenticated users, including the presence of recipe names.
  - Test that the recipe index view redirects to the login page for unauthenticated users.
- **Recipe Show View**:
  - Test that the recipe show view is displayed correctly for authenticated users, including the presence of recipe details (name and description).
  - Test that the recipe show view returns a 404 status for a non-existent recipe.
  - Test that the recipe show view redirects to the login page for unauthenticated users.

### Feature Tests
- **User Registration**:
  - Test that a user can register with valid data.
  - Test that registration fails with invalid data.
- **User Login**:
  - Test that a user can log in with valid credentials.
  - Test that login fails with invalid credentials.

## Evaluation
1. **Detected Errors**: API failure, incorrect data structure.
2. **Undetected Errors**: Data accuracy, external data manipulation.
3. **Conclusion**: High confidence in system correctness under normal and error conditions, assuming accurate external data.

## Link to Heroku website
- **Link**: [http://ap-app-93ed80a634e1.herokuapp.com/](http://ap-app-93ed80a634e1.herokuapp.com/)
