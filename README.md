# cockpit_GroupBoundAssets

addon for  https://github.com/agentejo/cockpit

**Purpose:**

As soon as this plugin is installed cockpit will look up the current (logged in) user's group when he opens the assets browser and will only show asset-files uploaded by his/that group. Assets that have been uploaded by users of foreign groups will not be shown to the current user in the assets-view.

**TODO**
 - check what happens when a user does not have a group (think this may happen and cause failures)
 - add a hook to the assets view/list that makes the assets list at least show the creator's group (perhaps later more)
 
 ## Other projects according to cockpit
https://github.com/serjoscha87/cockpit_GROUPS/
