# clickcount
Small Drupal 8 module that adds a statistic logging functionnality (Ajax) on a 'job' content type
The 'job' content type presents information to apply the job. 
The purpose of this module is to replace these informations with a button that will display these informations and log the click in a database using Ajax.
To use this module you need to adapt this files to your field names :
- clickcount.module (field_section_contact)
- js/hideinfos_showbutton.js (see selectors)
