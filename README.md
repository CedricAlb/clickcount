# clickcount
Small Drupal 8 module that adds a statistic logging functionnality (Ajax) on a 'job' content type
## Context
The 'job' content type presents informations to apply the job (address, email, phone, etc.). 
The purpose of this module is to replace these informations with a button that will display these informations and log the click in a database using Ajax.
The module provide a report page displaying monthly clicks for the 12 last months.
## Reuse
To use this module you may need to adapt these files with your custom field names :
- clickcount.module (field_section_contact)
- js/hideinfos_showbutton.js (see selectors)
