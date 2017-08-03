[![](https://scdn.rapidapi.com/RapidAPI_banner.png)](https://rapidapi.com/package/OutlookMail/functions?utm_source=RapidAPIGitHub_OutlookMailFunctions&utm_medium=button&utm_content=RapidAPI_GitHub)

# OutlookMail Package
The Outlook Mail API lets you read, create, and send messages and attachments, view and respond to event messages, and manage folders that are secured by Azure Active Directory in Office 365.
* Domain: [OutlookMail](http://outlook.com)
* Credentials: clientId, clientSecret

## How to get credentials: 
0. Go to [Outlook dev centre](https://developer.microsoft.com/en-us/outlook/)
1. Register or log in
2. Create you application to get your clientId and clientSecret

## Custom datatypes: 
 |Datatype|Description|Example
 |--------|-----------|----------
 |Datepicker|String which includes date and time|```2016-05-28 00:00:00```
 |Map|String which includes latitude and longitude coma separated|```50.37, 26.56```
 |List|Simple array|```["123", "sample"]``` 
 |Select|String with predefined values|```sample```
 |Array|Array of objects|```[{"Second name":"123","Age":"12","Photo":"sdf","Draft":"sdfsdf"},{"name":"adi","Second name":"bla","Age":"4","Photo":"asfserwe","Draft":"sdfsdf"}] ```
 

## OutlookMail.getAccessToken
Get access token

| Field       | Type       | Description
|-------------|------------|----------
| clientId    | credentials| Client id received from Microsoft
| clientSecret| credentials| Client secret received from Microsoft
| redirectUri | String     | Redirect uri for your application
| code        | String     | Code provided by user

## OutlookMail.getMessages
Get a message collection from the entire mailbox of the signed-in user (including the Deleted Items and Clutter folders).

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token received from Outlook Mail
| folderId   | String| The folder ID, or the Inbox, Drafts, SentItems, or DeletedItems well-known folder name, if you're getting messages from a specific folder. Specifying AllItems would return all messages from the entire mailbox
| select     | String| Specify only those properties you need for best performance: Sender, Subject etc

## OutlookMail.sendMessage
Send the message supplied in the request body

| Field          | Type   | Description
|----------------|--------|----------
| accessToken    | String | Access token received from Outlook Mail
| message        | JSON   | The message to send.
| savetoSentItems| Boolean| Indicates whether to save the message in Sent Items. Default is true.

## OutlookMail.createDraftMessage
Create a draft of a new message.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token received from Outlook Mail
| message    | JSON  | The message to create.
| folderId   | String| The folder ID, or the Inbox, Drafts, SentItems, or DeletedItems well-known folder name, if you're getting messages from a specific folder. Specifying AllItems would return all messages from the entire mailbox

## OutlookMail.sendDraftMessage
Create a draft of a new message.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token received from Outlook Mail
| messageId  | String| The message id to send.

## OutlookMail.getSingleMessage
Get a message by ID.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token received from Outlook Mail
| messageId  | String| The message id to send.

## OutlookMail.replyToSender
Reply to the sender of a message by specifying a comment

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token received from Outlook Mail
| messageId  | String| The message id to send.
| comment    | String| A comment to include

## OutlookMail.replyToAllRecipients
Reply to all recipients of a message by specifying a comment

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token received from Outlook Mail
| messageId  | String| The message id to send.
| comment    | String| A comment to include

## OutlookMail.createDraftReplyMessage
Create a draft of a reply message to add a comment

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token received from Outlook Mail
| messageId  | String| The message id to send.
| comment    | String| A comment to include

## OutlookMail.createDraftReplyAllMessage
Create a draft of a reply-all message to add a comment

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token received from Outlook Mail
| messageId  | String| The message id to send.
| comment    | String| A comment to include

## OutlookMail.createForwardMessage
Forward a message by using the Forward method and optionally specifying a comment. The message is then saved in the Sent Items folder.

| Field       | Type  | Description
|-------------|-------|----------
| accessToken | String| Access token received from Outlook Mail
| messageId   | String| The message id to send.
| comment     | String| A comment to include. Can be an empty string.
| toRecipients| List  | Array ot JSON objects of recipients

## OutlookMail.createDraftForwardMessage
Create a draft of the Forward message to add a comment or recipients in one CreateForward call. You can then update message properties and send the draft.

| Field       | Type  | Description
|-------------|-------|----------
| accessToken | String| Access token received from Outlook Mail
| messageId   | String| The message id to send.
| comment     | String| A comment to include. Can be an empty string.
| toRecipients| List  | Array ot JSON objects of recipients

## OutlookMail.updateMessage
Change writable properties on a draft or existing message. Only the properties that you specify are changed.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token received from Outlook Mail
| messageId  | String| The message id to send.
| message    | JSON  | Message properties to update

## OutlookMail.deleteMessage
Delete a message.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token received from Outlook Mail
| messageId  | String| The message id to send.

## OutlookMail.moveMessage
Move a message to a folder. This creates a new copy of the message in the destination folder.

| Field        | Type  | Description
|--------------|-------|----------
| accessToken  | String| Access token received from Outlook Mail
| messageId    | String| The message id to send.
| destinationId| String| The destination folder ID, or the Inbox, Drafts, SentItems, or DeletedItems well-known folder name.

## OutlookMail.copyMessage
Copy a message to a folder.

| Field        | Type  | Description
|--------------|-------|----------
| accessToken  | String| Access token received from Outlook Mail
| messageId    | String| The message id to send.
| destinationId| String| The destination folder ID, or the Inbox, Drafts, SentItems, or DeletedItems well-known folder name.

## OutlookMail.updateMessageClassification
Change the InferenceClassification property of the specified message.

| Field                  | Type  | Description
|------------------------|-------|----------
| accessToken            | String| Access token received from Outlook Mail
| messageId              | String| The message id to send.
| inferenceClassification| Select| Inference classification property of the message
| userId                 | String| The user's email address.

## OutlookMail.createOverrideForSender
Create an override for a sender identified by an SMTP address. Future messages from that SMTP address will be consistently classified as specified in the override

| Field             | Type  | Description
|-------------------|-------|----------
| accessToken       | String| Access token received from Outlook Mail
| classifyAs        | String| Specifies how incoming messages from a specific sender should always be classified as.
| senderEmailAddress| JSON  | The email address of the sender for whom the override is created.
| userId            | String| The user's email address.

## OutlookMail.getAllUserOverrides
Get the overrides that a user has set up to always classify messages from certain senders in specific ways.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token received from Outlook Mail
| userId     | String| The user's email address.

## OutlookMail.updateOverrideForSender
Change the classifyAs field of an override as specified.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token received from Outlook Mail
| overrideId | String| Id of the override
| classifyAs | String| Specifies how incoming messages from a specific sender should always be classified as.
| userId     | String| The user's email address.

## OutlookMail.deleteSenderOverride
Delete an override specified by its ID.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token received from Outlook Mail
| overrideId | String| Id of the override
| userId     | String| The user's email address.

## OutlookMail.getMailboxSettings
Get the settings for the primary mailbox of the signed-in user. Examples of settings include the user's preferred language and default time zone, and any automatic reply settings.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token received from Outlook Mail

## OutlookMail.getAutoReplySettings
Get the automatic reply settings of the signed-in user's mailbox.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token received from Outlook Mail

## OutlookMail.updateAutoReplySettings
Automatic replies are part of the user's mailbox settings (represented by MailboxSettings). You can enable, configure, or disable automatic replies by updating the corresponding mailbox settings.

| Field                  | Type  | Description
|------------------------|-------|----------
| accessToken            | String| Access token received from Outlook Mail
| automaticRepliesSetting| JSON  | JSON object with new settings

## OutlookMail.getAttachments
You can get an attachment collection.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token received from Outlook Mail
| messageId  | String| The message id.
| select     | String| Use $select to specify only those properties you need for best performance.

## OutlookMail.getSingleAttachment
You can get single attachment.

| Field       | Type  | Description
|-------------|-------|----------
| accessToken | String| Access token received from Outlook Mail
| messageId   | String| The message id.
| attachmentId| String| The attachement id.
| select      | String| Use $select to specify only those properties you need for best performance.

## OutlookMail.createFileAttachment
Add a file attachment to a message.

| Field       | Type  | Description
|-------------|-------|----------
| accessToken | String| Access token received from Outlook Mail
| messageId   | String| The message id.
| name        | String| The name of the attachment.
| contentBytes| File  | The file to attach
| contentType | String| The MIME type of the attachment.

## OutlookMail.createItemAttachment
Add an item attachment to a message.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token received from Outlook Mail
| messageId  | String| The message id.
| name       | String| The name of the attachment.
| item       | JSON  | The item to attach.

## OutlookMail.createReferenceAttachment
Add a reference attachment to a message.

| Field       | Type   | Description
|-------------|--------|----------
| accessToken | String | Access token received from Outlook Mail
| messageId   | String | The message id.
| name        | String | The name of the attachment.
| sourceUrl   | String | URL to get the attachment content.
| isFolder    | Boolean| Specifies whether the attachment is a link to a folder. Must set this to true if SourceUrl is a link to a folder.
| isInline    | Boolean| true if the attachment is an inline attachment; otherwise, false. 
| permission  | Select | Specifies the permissions granted for the attachment by the type of provider in providerType.
| previewUrl  | String | Applies to only a reference attachment of an image - URL to get a preview image.
| providerType| Select | The type of provider that supports an attachment of this contentType.
| thumbnailUrl| String | Applies to only a reference attachment of an image - URL to get a thumbnail image. 
| contentType | String | The MIME type of the attachment.

## OutlookMail.deleteAttachments
Delete the specified attachment of a message. The attachment can be a file attachment or item attachment.

| Field       | Type  | Description
|-------------|-------|----------
| accessToken | String| Access token received from Outlook Mail
| messageId   | String| The message id.
| attachmentId| String| The attachement id.

## OutlookMail.getFolders
Get the folder collection under the root folder of the signed-in user (.../me/MailFolders), or under the specified folder.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token received from Outlook Mail
| folderId   | String| The folder ID, or the Inbox, Drafts, SentItems, or DeletedItems well-known folder name, if you're getting messages from a specific folder. Specifying AllItems would return all messages from the entire mailbox

## OutlookMail.synchronizeFolderHierarchy
You can get a flat table of all folders in a mailbox. When you synchronize a mail folder hierarchy, request this category.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token received from Outlook Mail
| deltaLink  | String| The token that indicates the last time that the folder hierarchy was synchronized.

## OutlookMail.synchronizeMessages
You can synchronize your local data store with the messages on the server. Message synchronization is a per-folder operation, for example, you can synchronize all of the messages in your Inbox. To synchronize the messages in a folder hierarchy you need to synchronize each folder individually.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token received from Outlook Mail
| folderId   | String| The folder ID, or the Inbox, Drafts, SentItems, or DeletedItems well-known folder name, if you're getting messages from a specific folder. Specifying AllItems would return all messages from the entire mailbox
| deltaToken | String| The token that identifies the last sync request for that folder. It is returned as part of the value for @odata.deltaLink in that previous sync response. Required for the second GET request.
| skipToken  | String| The token that indicates that there are more messages to download. Required if it is returned as part of the value for @odata.nextLink in the previous sync response.

## OutlookMail.createFolder
Create a child folder by the name specified in displayName.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token received from Outlook Mail
| folderId   | String| The folder ID, or the Inbox, Drafts, SentItems, or DeletedItems well-known folder name, if you're getting messages from a specific folder. Specifying AllItems would return all messages from the entire mailbox
| displayName| String| The display name of the folder.

## OutlookMail.updateFolder
Change the folder name to that specified in displayName. 

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token received from Outlook Mail
| folderId   | String| The folder ID
| displayName| String| The display name of the folder.

## OutlookMail.moveFolder
Move a folder and its contents to another folder

| Field        | Type  | Description
|--------------|-------|----------
| accessToken  | String| Access token received from Outlook Mail
| folderId     | String| The folder ID
| destinationId| String| The destination folder ID, or the Inbox, Drafts, SentItems, or DeletedItems well-known folder name.

## OutlookMail.copyFolder
Copy a folder and its contents to another folder

| Field        | Type  | Description
|--------------|-------|----------
| accessToken  | String| Access token received from Outlook Mail
| folderId     | String| The folder ID
| destinationId| String| The destination folder ID, or the Inbox, Drafts, SentItems, or DeletedItems well-known folder name.

## OutlookMail.deleteFolder
Delete a folder and its contents

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token received from Outlook Mail
| folderId   | String| The folder ID

