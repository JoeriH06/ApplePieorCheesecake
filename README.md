# forecastbaking

# Test Plan

## PDF file with whole plan ->
 ![here](public\pdfplan\testdock.pdf)

## User Stories
1. **Viewing Enappsys Data**
   - Happy Path: The data is successfully retrieved and displayed.
   - Unhappy Path: The data cannot be retrieved due to an error.

2. **Data Classification**
   - Happy Path: The data is classified correctly based on the given price ranges.
   - Unhappy Path: The data classification fails due to incorrect data format.

## Tests
- **Unit Tests:** Test individual functions and logic.
- **Feature Tests:** Test the system's behavior with real HTTP requests and responses.

## Evaluation
1. **Detected Errors:** API failure, incorrect data structure.
2. **Undetected Errors:** Data accuracy, external data manipulation.
3. **Conclusion:** High confidence in system correctness under normal and error conditions, assuming accurate external data.

## Link to Heroku website
- **link** https://dashboard.heroku.com/apps/ap-app
