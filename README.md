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
#
	###Login Change
Facebook Login Changelog
2018-07-02
Recent Changes to Facebook Login
Facebook Login has changed a lot in the past few months as we work to help protect people's privacy and give them greater control over their information. We realize it can be challenging to stay on top of all of the updates. To help you, we've compiled a summary of the recent changes, along with recommendations for incorporating them.

Key Dates
Keep in mind the following deadlines to help ensure smooth operation of your app or website.

August 1, 2018: Re-request access to Facebook Login permissions, if necessary, through App Review
October 6, 2018: Opt-in to “Enforce HTTPS” (will be automatically enabled after this date)
November 1, 2018: Migrate to PSID from ASID for apps using page management and bot messaging permissions
January 8, 2019: Upgrade to Graph API v.3.0
Additional Review Required for Certain Permissions
In order to help protect people's data, we're now requiring that an increased number of permissions go through the App Review process. For certain permissions, we are also requiring business verification and a contract between your business and Facebook. Businesses can be verified by providing forms of documentation including utility bills, business licenses, certificates of formation, articles of incorporation, tax ID numbers, and others. The contract introduces additional security requirements and other provisions around data. You can read more about the enhanced App Review process in the App Review topic.

The table below summarizes the level of review necessary for Facebook Login permissions. Check back often for updates to this table.

App Review NOT Required	App Review Required	App Review, Business Verification, and Contract Required
name

user_gender*

user_friends

email

user_age_range*

user_likes

profile_picture

user_link* (Facebook profile page links)

user_photos

user_birthday

user_tagged_places

user_location (current city)

user_videos

user_hometown

user_events

user_managed_groups

user_posts

* If you have not yet upgraded to Graph API, we recommend that you re-request these permissions by August 1. If approved for access, they will continue to be available to you after you upgrade to Graph API v3.0. Changes to Graph API v3.0 are detailed in this blog post from May 1, 2018. Apps have until Jan 8, 2019 to upgrade to Graph API v3.0.

If your app or website was already using the permissions shown in the table above before May 1, 2018 when our enhanced review began, you have until August 1, 2018 to re-request access and ensure you can continue to use them after then.

Third-party tech providers
Businesses that build with the Facebook platform to serve other businesses as a third-party tech provider must also sign an additional contract. The tech provider contract restricts the usage of data to the sole purpose of servicing the customer on behalf of whom the data is collected. Large customers using third-party tech providers may be subject to App Review and may be required to sign the supplemental terms. Tech Providers must identify their business use as providing services to other businesses in the settings of the App Dashboard.

Deprecated Facebook Login Permissions and APIs
We have deprecated certain permissions and features, as shown in the table below. The fields previously accessible through these permissions will no longer be returned and APIs will return empty values.

Extended Profile Permissions	User Actions Permissions	APIs
user_religion_politics

user_actions.books

Taggable Friends

user_relationships

user_actions.fitness

All Mutual Friends

user_relationship_details

user_actions.music

user_custom_friendlists

user_actions.video

user_about_me

user_actions.new

user_education_history

user_games_activity

user_work_history

user_website

Read the blog post from April 4, 2018 for more information.

The publish_actions permission was deprecated as of April 24, 2018. Apps created before this date that were previously approved to request publish_actions can continue to do so until August 1, 2018. If you were using publish_actions, we recommend switching to Facebook's Share dialogs for web, iOS and Android. (Read the blog post from May 1, 2018.)

The following permissions are no longer available to request as of May 1, 2018 and will be deprecated starting January 8, 2019 for apps and websites that gained approval prior to May 1, 2018:

timezone
locale
cover
is_verified
updated_time
verified
currency
devices
third_party_id
See the blog post from May 1, 2018.

You can see the full list of permissions at Permissions Reference.

Profile Links
Links to user profiles built using ASIDs no longer function. You must retrieve a profile link from the user_link field. These links will not function if the person hasn't used your app or website in 90 days, or if the person has declined to grant the user_link permission to your app. After migrating to Graph API v3.0, this field will only be available if your app requests and the user approves the permission.

The user_link will only resolve to the user's actual Facebook profile for logged-in individuals in that person's extended network (currently defined as friends-of-friends but subject to change). Other individuals may only have the opportunity to send a friend or message request.

Read the blog post from April 19, 2018 announcing these changes.

Access Tokens
Renewing Access Tokens
Your application's access to user data now expires after 90 days unless Facebook is able to verify activity in your app. On some platforms, like Facebook web games, all user activity may be verifiable, and on other platforms, like iOS, users may have to re-authorize your application's data access by accepting permissions in a Login dialog every 90 days. Read the blog post from April 9, 2018.

We recommended that you make sure your apps/websites have a smooth re-authorization flow for people whose access tokens have expired. Read more about refreshing access tokens at Refreshing User Access Tokens

Token Expiration
We've clarified the difference between visitors who never logged in and users with expired access tokens so that developers can show the most appropriate user interface for each situation. For apps using the JavaScript SDK, FB.getLoginStatus() allows you to determine the state a user is in, and now returns a new status, authorization_expired, to indicate that a user's token has expired. This new state is distinct from the not_authorized state that you'll get for users who have not formed a connection to your app via Facebook Login. For this new expired state, you might remind the individual they've previously logged in with Facebook and prompt them to go through the login flow again to refresh their account with their latest info.

We're also providing a new way for developers to test token expiration in their apps and websites. For each test user created for your app, you'll be able to choose the length of time before the access tokens expire. If you choose to use a custom expiration time, you can set the interval for as short as one minute or much longer if needed for your unique app testing purposes. You can find this setting under the Edit menu for each test user, and it applies to all of the apps or websites used by the test user.

For the JavaScript SDK, we're adding a new field to the authResponse object called reauthorize_required_in. This gives developers working with short lived tokens the ability to know when a person's 90 day authorization of the app will expire. If you want to proactively extend the person's session by another 90 days, you can call login() with the auth_type=reauthorize parameter, which will ask them to accept the permissions currently granted to your app again in order to continue.

These updates were announced in a blog post on May 1, 2018.

HTTPS required
A new Enforce HTTPS setting for Facebook Login is now available in App Dashboard. When turned on, it requires all Facebook Login redirects to use HTTPS, and all Facebook JavaScript SDK calls that return or require an access token to occur only from HTTPS pages. Read the blog post from June 8, 2018.

All new apps created since March 2018 have already been required to use this setting, and existing apps and websites using Facebook Login have until October 6, 2018 to opt in before it will automatically be enabled. Any insecure redirect URIs or pages making Login or API calls with the JavaScript SDK from HTTP pages will stop working after that date.

Business Integrations
“Business Integrations” appears as a distinct list of services separate from apps under a person's account settings. These are services that people connected to their Facebook account and granted special permissions to manage pages, events, ads, or page messaging. Your access to business APIs will continue to work as it did prior to this change, without expiration, until such time as a Facebook user removes the integration to the page, ad account, event, etc. Read the blog post from May 1, 2018 announcing this change.

Personal Data Deletion
If people remove your app or website from Facebook's apps and websites settings, we can provide them with the option to request that your app or website delete all information you received about them from Facebook. The experience on Facebook will inform people when they sent a request and when it was acknowledged by your service. It will also provide them with a confirmation number you supply and a way to check the status of their request. Offering this option to people can help you automate customer service requests, demonstrate that you're handling their information responsibly, and help meet your compliance requirements, such as for the GDPR.

To enable this option, we need you to provide us with a callback URL where we can send the request. You can add the callback URL at your app's Facebook Login Settings page in the app dashboard. Your callback must use HTTPS. See the documentation for details. Read the blog post from May 25, 2018.

Data Protection Officer contact information
We are now offering a way for you to easily provide your DPO's contact information to European users. Go to your app's Facebook Login Settings page in the app dashboard to add your DPO's name (optional), mailing address, and email address. This information will be made available in people's apps and website settings so that they can contact your DPO if they have questions about how their data is processed and used. Read the blog post from May 25, 2018.

Development Mode
For apps in development mode, API calls will return user data only for those with a role in the app (i.e., admin, developer, or tester). This applies to the Facebook Profile, Pages, and other APIs. Read the blog post from April 24, 2018.

Apps in development mode are now rate-limited to 200 calls per hour, per page-app pair, and can only access users who have a role on the app (admin, developer, or tester). View the charts for your app's rate limit activity on your app dashboard. Developers and Admins of apps in public mode can only access the permissions the app was approved for.

We recommend that developers take these limitations into account when developing new features for their apps.

Important References and Tools
If your app or website has been affected by recent changes and you have an escalation for Facebook to review, please use this form: https://go.fb.com/2018-FB4D-platform-review-form.html.
For more information on the App Review process and APIs and permissions that require review, visit: https://developers.facebook.com/docs/apps/review.
The API Update Tool helps to assess migration impact to the latest or more recent Graph API Level. To see which of your app's API calls will be affected by changes in newer versions of the API, go to https://developers.facebook.com/tools/api_versioning/.
To check the operational status of Facebook Login and to see examples of the code you can get back from Facebook Login based on your permissions, navigate to the sample app at fbrell.com.
To follow the latest changes to Graph API:
Change Log: https://developers.facebook.com/docs/graph-api/changelog
Breaking Changes: https://developers.facebook.com/docs/graph-api/changelog/breaking-changes	
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
