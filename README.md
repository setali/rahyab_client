# rahyab_client

<h3> Installation </h3>

Download this package and add in your project.

<h3> How to work? </h3>
include "src/ClientManager" then  create a new ClientManager().<br>
Ex. <code> $cm = new ClientManager('soap', 'your username', 'your password'); </code>

<h3> Functions </h3><br><br>

<b>Send SMS:</b> <br><br> Ex. <code> $cm->->getConnector()->sendSms($sender, $receivers , $message, $encoding);</code>
<table>
<tr> <th> Prameter </th>  <th>  Type</th> <th> explain </th> <th> example </th>  </tr>
<tr> <td> $sender </td> <td> String </td> <td> Sender Number </td> <td> '50001' </td> </tr>
<tr> <td> $receivers </td> <td> Array Strings </td> <td> Receivers Number </td> <td> ['9*********','9*********'] </td> </tr>
<tr> <td> $message </td> <td> String </td> <td> Your Message </td> <td> "Test Message" </td> </tr>
<tr> <td> $encoding </td> <td> Boolean </td> <td> Message Encoding </td> <td> true for UTF8 and false for ASCII </td> </tr>
</table>


<b>Get Credit:</b>
 <br> Ex.
 <code> $cm->getConnector()->getCredit() </code>
 
 - This function don`t have input;

<b>Get Message:</b>
  <br> Ex.
 <code> $cm->getConnector()->getMessages($lastRowMessageId) </code>
 
 <table>
 <tr> <th> Prameter </th>  <th>  Type</th> <th> explain </th> <th> example </th>  </tr>
 <tr> <td> $lastRowMessageId </td> <td> long </td> <td> Last Row Message ID </td> <td> 1946663772 </td> </tr>

 </table>

<b>Get Message Status:</b>
  <br> Ex.
 <code> $cm->getConnector()->getMessagesStatus($messageIDs) </code>
<table>
 <tr> <th> Prameter </th>  <th>  Type</th> <th> explain </th> <th> example </th>  </tr>
 <tr> <td> $messageIDs </td> <td> Array Strings </td> <td> Message Id that want status </td> <td> ['1948512018','1948512019'] </td> </tr>

 </table>

<br>
Example file: src/index.php
