@IbexaHeadless @IbexaExperience @IbexaCommerce
Feature: An example test checking if user can login and if behat config is proper.

  @javascript
  Scenario: User can log in as admin user
    Given I log in as 'admin' with password 'publish'
