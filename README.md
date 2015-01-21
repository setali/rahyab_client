# rahyab_client

<h3> Installation </h3>

Download this package and add in your project.

<h3> How to work? </h3>
include "src/ClientManager" then  create a new ClientManager().<br>
example: <code> $cm = new ClientManager('soap', 'your username', 'your password'); </code>

<h3> Functions </h3>

Send SMS: <br> <code> $cm->->getConnector()->sendSms('50001********', ['9*********','9*********'], 'Test Message', "encoding");</code>
<table>
<tr> Input </tr>
<tr> <th> Your Number </th>  <th>  String</th> <th> explain </th> </tr>
</table>

Get Credit: <code> $cm->getConnector()->getCredit() </code>

Get Message: <code> $cm->getConnector()->getMessages("Last row messages ID ") </code>

Get Message Status: <code> $cm->getConnector()->getMessagesStatus("Array of Message IDs ") </code>


<br>
Example file: src/incex.php
