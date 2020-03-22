# Database modification

 as most of the queries for this task are executed against sessions the following modifications are applied to existing schema
 
 - a user has one to many sessions [one to many]
 - a session has only one score
 - a session belongs to one course
 - a session and has many exercises [many to many]
 - an exercise belongs to many sessions [many to many]
 - an exercise belongs to only one category 
 - a course has one to many exercises
 - a session has only one course

**note:** if exercises are meant to be shared with courses then they could be connected to courses through a  many to many relationship. 


