# cockpit_GroupBoundAssets

addon for  https://github.com/agentejo/cockpit

**Purpose:**

As soon as this plugin is installed cockpit will look up the user's group and will only show assets uploaded by this found group - assets that have been uploaded by foreign groups will not be shown by cockpit.

**TODO**
 - check what happens when a user does not have a group (think this may happen and cause failures)
 - add a hook to the assets view that at least show the creator's group
