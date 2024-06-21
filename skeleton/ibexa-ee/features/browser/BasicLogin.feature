@IbexaHeadless @IbexaExperience @IbexaCommerce
Feature: An example test checking if user can login and if behat config is proper.

  @javascript
  Scenario: User can log in as admin user
    Given I open Login page in admin SiteAccess
    When I log in as admin with password publish
    Then I should be on Dashboard page
