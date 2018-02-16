# modx_tvtable_colrowspan

add rowspan/colspan to the TV table

Usage:

**************************************

Colspan:


add colspan=2 to the field ofTVTable

In next td field type colfalse

Accordingly, colspan=3 needs colfalse colfalse in next two td`s

|td|some text colspan=2|td|

|td|colfalse|td|

|td|Some text|td|

***********************************

Rowspan

Same way:

add rowspan=2

and in td field below type rowfalse

|tr|

  |td|some text rowspan=2|td| |td|Some text|td| |td|Some text|td|
  
|tr|

|tr|

  |td|rowfalse|td||td|Some text|td||td|Some text|td|
  
|tr|


