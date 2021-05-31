### ***Opauth-Facebook***
=================================================
# *[Opauth][1] strategy for Facebook authentication.
#
# Implemented based on https://developers.facebook.com/docs/authentication/
#
# *Getting started
---------------------------
# *New Page Experience and Parameters
# Example
# * HTTPPHP SDKJavaScript SDKAndroid SDKiOS SDKcURLGraph API Explorer
# GET /v10.0/{person-id}/ HTTP/1.1
# Host: graph.facebook.com
#
# *If you want to learn how to use the Graph API, read our Using Graph API guide.
#
# *Default Public Profile Fields
# *The public_profile permission allows apps to read the following fields:
#
# id
# first_name
# last_name
# middle_name
# name
# name_format
# picture
# short_name
# Parameters
# *This endpoint doesn't have any parameters.
# Fields
# Field	Description
# id
# numeric string
# *The app user's App-Scoped User ID. This ID is unique to the app and cannot be used by other apps.
#
# Core
# about
# string
# *Returns no data as of April 4, 2018.
#
# age_range
# AgeRange
# *The age segment for this person expressed as a minimum and maximum age. For example, more than 18, less than 21.
#
# Core
# birthday
# string
# *The person's birthday. This is a fixed format string, like MM/DD/YYYY. However, people can control who can see the year they were born separately # from the month and day so this string can be only the year (YYYY) or the month + day (MM/DD)
#
# Core
# currency
# Currency
# *The person's local currency information
#
# Deprecated
# education
# list<EducationExperience>
# Returns no data as of April 4, 2018.
#
# email
# string
# The User's primary email address listed on their profile. This field will not be returned if no valid email address is available.
# 
# Core
# favorite_athletes
# list<Experience>
# Athletes the User likes.
# 
# favorite_teams
# list<Experience>
# Sports teams the User likes.
#
first_name
string
The person's first name
#
Core
gender
string
The gender selected by this person, male or female. If the gender is set to a custom value, this value will be based off of the preferred pronoun; it will be omitted if the preferred pronoun is neutral

Core
hometown
Page
The person's hometown

inspirational_people
list<Experience>
The person's inspirational people

install_type
enum
Install type

installed
bool
Is the app making the request installed

interested_in
list<string>
Returns no data as of April 4, 2018.

is_eligible_promo
unsigned int32
Is eligible for promo

is_guest_user
bool
if the current user is a guest user. should always return false.

is_verified
bool
People with large numbers of followers can have the authenticity of their identity manually verified by Facebook. This field indicates whether the person's profile is verified in this way. This is distinct from the verified field

Deprecated
languages
list<Experience>
Facebook Pages representing the languages this person knows

last_name
string
The person's last name

Core
link
string
A link to the person's Timeline. The link will only resolve if the person clicking the link is logged into Facebook and is a friend of the person whose profile is being viewed.

Core
local_news_megaphone_dismiss_status
bool
Display megaphone for local news bookmark

Deprecated
local_news_subscription_status
bool
Daily local news notification

Deprecated
locale
string
The person's locale

CoreDeprecated
location
Page
The person's current location as entered by them on their profile. This field requires the user_location permission.

Core
meeting_for
list<string>
What the person is interested in meeting for

middle_name
string
The person's middle name

Core
name
string
The person's full name

CoreDefault
name_format
string
The person's name formatted to correctly handle Chinese, Japanese, or Korean ordering

payment_mobile_pricepoints
UserPaymentMobilePricepoints
Mobile payment pricepoints

payment_pricepoints
PaymentPricepoints
The person's payment pricepoints

political
string
Returns no data as of April 4, 2018.

profile_pic
string
The profile picture URL of the Messenger user. The URL will expire.

quotes
string
The person's favorite quotes

relationship_status
string
Returns no data as of April 4, 2018.

religion
string
Returns no data as of April 4, 2018.

shared_login_upgrade_required_by
datetime
The time that the shared login needs to be upgraded to Business Manager by

short_name
string
Shortened, locale-aware name for the person

significant_other
User
The person's significant other

sports
list<Experience>
Sports played by the person

supports_donate_button_in_live_video
bool
Whether the user can add a Donate Button to their Live Videos

third_party_id
string
A string containing an anonymous, unique identifier for the User, for use with third-parties. Deprecated for versions 3.0+. Apps using older versions of the API can get this field until January 8, 2019. Apps installed by the User on or after May 1st, 2018, cannot get this field.

Deprecated
timezone
float (min: -24) (max: 24)
The person's current timezone offset from UTC

CoreDeprecated
token_for_business
string
A token that is the same across a business's apps. Access to this token requires that the person be logged into your app or have a role on your app. This token will change if the business owning the app changes

updated_time
datetime
Updated time

Deprecated
verified
bool
Indicates whether the account has been verified. This is distinct from the is_verified field. Someone is considered verified if they take any of the following actions:

                                                                                                                                                                    * Register for mobile
                                                                                                                                                                    * Confirm their account via SMS
                                                                                                                                                                    * Enter a valid credit card
Deprecated
video_upload_limits
VideoUploadLimits
Video upload limits

website
string
Returns no data as of April 4, 2018.

Edges
Edge	Description
accounts
Pages the User has a role on.

ad_studies
Ad studies that this User's can view.

adaccounts
The advertising accounts the User can access.

albums
The photo albums this person has created

apprequestformerrecipients
App requests

apprequests
This person's pending requests from an app

Core
assigned_ad_accounts
Ad accounts that are assigned to this business scoped user

assigned_business_asset_groups
Business asset groups that are assign to this business scoped user

assigned_pages
Pages that are assigned to this business scoped user

assigned_product_catalogs
Product catalogs that are assigned to this business scoped user

business_users
Business users corresponding to the user

businesses
Businesses associated with the user

conversations
Facebook Messenger conversation

cover
UserCoverPhoto
The person's cover photo

Deprecated
custom_labels
custom_labels

feed
The posts and links published by this person or others on their profile

friends
The person's friends

Core
groups
The Facebook Groups for which the person has given any group level permission

ids_for_apps
Businesses can claim ownership of multiple apps using Business Manager. This edge returns the list of IDs that this user has in any of those other apps

ids_for_business
Businesses can claim ownership of multiple apps using Business Manager. This edge returns the list of IDs that this user has in any of those other apps

ids_for_pages
Businesses can claim ownership of apps and pages using Business Manager. This edge returns the list of IDs that this user has in any of the pages owned by this business

likes
All the Pages this person has liked

live_encoders
Live encoders owned by this person

live_videos
Live videos from this person

music
Music this person likes

payment.subscriptions
Payment subscriptions

permissions
The permissions that the person has granted this app

Core
personal_ad_accounts
The advertising accounts to which this person has personal access

photos
Photos the person is tagged in or has uploaded

picture
The person's profile picture

Core
rich_media_documents
A list of rich media documents belonging to Pages that the user has advertiser permissions on

videos
Videos the person is tagged in or uploaded

Error Codes
Error	Description
100	Invalid parameter
200	Permissions error
190	Invalid OAuth 2.0 Access Token
459	The session is invalid because the user has been checkpointed
368	The action attempted has been deemed abusive or is otherwise disallowed
613	Calls to this api have exceeded the rate limit.
210	User not visible
80004	There have been too many calls to this ad-account. Wait a bit and try again. For more info, please refer to https://developers.facebook.com/docs/graph-api/overview/rate-limiting.
452	Session key invalid. This could be because the session key has an incorrect format, or because the user has revoked this session
110	Invalid user id
Creating
You can't perform this operation on this endpoint.
Updating
You can update a User by making a POST request to /{user_id}.
Parameters
Parameter	Description
emoji_color_pref
int64
emoji color preference.

firstname
string
This person's first name

lastname
string
This person's last name

local_news_megaphone_dismiss_status
enum {YES, NO}
Dismisses local news megaphone

local_news_subscription_status
enum {STATUS_ON, STATUS_OFF}
Preference for setting local news notifications

name
string
Used for test accounts only. Name for this account

password
string
Used for test accounts only. Password for this account

Return Type
This endpoint supports read-after-write and will read the node to which you POSTed.
Struct {
success: bool,
}
Error Codes
Error	Description
200	Permissions error
100	Invalid parameter
240	Desktop applications cannot call this function for other users
459	The session is invalid because the user has been checkpointed
210	User not visible
3000001	The feature is not supported in this Workplace community
270	This Ads API request is not allowed for apps with development access level (Development access is by default for all apps, please request for upgrade). Make sure that the access token belongs to a user that is both admin of the app and admin of the ad account
You can update a User by making a POST request to /{user_id}/game_items.
Parameters
Parameter	Description
action
enum {MARK, CONSUME, DROP}
Action to trigger on an inventory item

Required
app_id
application ID
Overrides the application from the user access token. Must be another app within the business

drop_table_id
game_drop_table ID
What loot drop table to trigger for the DROP action

ext_id
string
External id assigned by the game for the item

item_id
game_item ID
What item id to target for the MARK and CONSUME actions

quantity
int64
SELF_EXPLANATORY

Return Type
Struct {
id: unsigned integer,
count: unsigned integer,
created: timestamp,
item_def: string,
status: enum,
updated: timestamp,
ext_id: string,
}
Error Codes
Error	Description
100	Invalid parameter
You can update a User by making a POST request to /{custom_audience_id}/users.
Example
HTTPPHP SDKJavaScript SDKAndroid SDKiOS SDKcURLGraph API Explorer
POST /v10.0/<CUSTOM_AUDIENCE_ID>/users HTTP/1.1
Host: graph.facebook.com

payload=%7B%22schema%22%3A%5B%22EMAIL%22%2C%22LOOKALIKE_VALUE%22%5D%2C%22data%22%3A%5B%5B%229b431636bd164765d63c573c346708846af4f68fe3701a77a3bdd7e7e5166254%22%2C44.5%5D%2C%5B%228cc62c145cd0c6dc444168eaeb1b61b351f9b1809a579cc9b4c9e9d7213a39ee%22%2C140%5D%2C%5B%224eaf70b1f7a797962b9d2a533f122c8039012b31e0a52b34a426729319cb792a%22%2C0%5D%2C%5B%2298df8d46f118f8bef552b0ec0a3d729466a912577830212a844b73960777ac56%22%2C0.9%5D%5D%7D
If you want to learn how to use the Graph API, read our Using Graph API guide.
Parameters
Parameter	Description
payload
Object
Payload representing users to add

session
Object
Information about the session. Sessions are used when you have a lot of users to upload. For example, if you have 1 million users to upload, you need to split them into at least 100 requests because each request can only take 10k users. Specify the session info so that you can track if the session has finished or not.

Return Type
This endpoint supports read-after-write and will read the node to which you POSTed.
Struct {
audience_id: numeric string,
session_id: numeric string,
num_received: int32,
num_invalid_entries: int32,
invalid_entry_samples: Map {
string: string
},
}
Error Codes
Error	Description
100	Invalid parameter
200	Permissions error
2650	Failed to update the custom audience
294	Managing advertisements requires an access token with the extended permission for ads_management
105	The number of parameters exceeded the maximum for this operation
368	The action attempted has been deemed abusive or is otherwise disallowed
1. Install Opauth-Facebook:
   ```bash
   cd path_to_opauth/Strategy
   git clone https://github.com/opauth/facebook.git Facebook
   ```
   or
   ```
   composer require opauth/facebook
   ```

2. Create Facebook application at https://developers.facebook.com/apps/
   - Remember to enter App Domains
   - "Website with Facebook Login" must be checked, but for "Site URL", you can enter any landing URL.

3. Configure Opauth-Facebook strategy with at least `App ID` and `App Secret`.

4. Direct user to `http://path_to_opauth/facebook` to authenticate

Strategy configuration
----------------------

Required parameters:

```php
<?php
'Facebook' => array(
	'app_id' => 'YOUR APP ID',
	'app_secret' => 'YOUR APP SECRET'
)
```

Even though `fields` is an optional configuration parameter for Opauth-Facebook, for most cases you would like to explicitly define it. It should be defined in a comma-separated string. 

Refer to [Facebook Fields Reference](https://developers.facebook.com/docs/graph-api/reference/user) for list of valid fields.

License
---------
Opauth-Facebook is MIT Licensed  
Copyright © 2012 U-Zyn Chua (http://uzyn.com)

[1]: https://github.com/opauth/opauth
