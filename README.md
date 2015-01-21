# rahyab_client

<h3> Installation </h3>

Download this package and add in your project.

<h3> How to work? </h3>
include "src/ClientManager" then  create a new ClientManager().<br>
ex: <code> $cm = new ClientManager('soap', 'your username', 'your password'); </code>

<h3> Functions </h3>

Send SMS: <br> <code> $cm->->getConnector()->sendSms($sender, $receivers , $message, $encoding);</code>
<table>
<tr> Input: </tr>
<tr> <th> Prameter </th>  <th>  Type</th> <th> explain </th> <th> example </th>  </tr>
<tr> <td> $sender </td> <td> String </td> <td> Sender Number </td> <td> '50001' </td> </tr>
<tr> <td> $receivers </td> <td> Array Strings </td> <td> Receivers Number </td> <td> ['9*********','9*********'] </td> </tr>
<tr> <td> $message </td> <td> String </td> <td> Your Message </td> <td> "Test Message" </td> </tr>
<tr> <td> $encoding </td> <td> Boolean </td> <td> Message Encoding </td> <td> true for UTF8 and false for ASCII </td> </tr>
</table>


Get Credit:
 <br> ex: 
 <code> $cm->getConnector()->getCredit() </code>

Get Message:
  <br> ex: 
 <code> $cm->getConnector()->getMessages("Last row messages ID ") </code>

Get Message Status:
  <br> ex: 
 <code> $cm->getConnector()->getMessagesStatus("Array of Message IDs ") </code>


<br>
Example file: src/incex.php
