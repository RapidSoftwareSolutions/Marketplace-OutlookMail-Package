       <?php
       $routes = [
       'getSingleMessage',
       'deleteFolder',
       'copyFolder',
       'moveFolder',
       'updateFolder',
       'createFolder',
       'synchronizeFolderHierarchy',
       'getFolders',
       'deleteAttachments',
       'createReferenceAttachment',
       'createItemAttachment',
       'createFileAttachment',
       'getSingleAttachment',
       'getAttachments',
       'updateAutoReplySettings',
       'getAutoReplySettings',
       'getMailboxSettings',
       'deleteSenderOverride',
       'updateOverrideForSender',
       'getAllUserOverrides',
       'createOverrideForSender',
       'updateMessageClassification',
       'copyMessage',
       'moveMessage',
       'deleteMessage',
       'updateMessage',
       'createDraftForwardMessage',
       'createForwardMessage',
       'createDraftReplyAllMessage',
       'createDraftReplyMessage',
       'replyToAllRecipients',
       'replyToSender',
       'sendDraftMessage',
       'createDraftMessage',
       'sendMessage',
       'synchronizeMessages',
        'getMessages',
        'metadata'
       ];
       foreach ($routes as $file) {
           require __DIR__ . '/../src/routes/' . $file . '.php';
       }
