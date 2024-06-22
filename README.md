# forecastbaking

# Test Plan

## PDF file with whole plan
![here](public/pdfplan/Testingdoc.pdf)

## User Stories
1. **User Registration**
   - Happy Path: A user successfully registers with valid data.
   - Unhappy Path: Registration fails with invalid data.

2. **User Login**
   - Happy Path: A user successfully logs in with valid credentials.
   - Unhappy Path: Login fails with invalid credentials.

3. **Recipe Index View**
   - Happy Path: Authenticated user views the list of recipes.
   - Unhappy Path: Unauthenticated user is redirected to the login page.

4. **Recipe Show View**
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

## Link to Heroku website
- **Link**: [http://ap-app-93ed80a634e1.herokuapp.com/](http://ap-app-93ed80a634e1.herokuapp.com/)
