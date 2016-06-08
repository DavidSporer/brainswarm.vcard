# brainswarm-vcard #

This extension extends femanager in order to synchronize changes to fe_user Users with a given CardDAV server.

### How to use it ###

Install the extension.
Afterwards you need to tell it the credentials of your CardDAV user that you want to use to sync data.

```
plugin.tx_brainswarm_vcard {
  settings {
      cardDav {
        baseUri = http://my-carddav-url
        username = my-username
        password = my-super-secure-password
      }
    }
}
```

Please note that you must have configured femanager in order to make this work. This extension enhances the functionality of the New and EditControllers of femanager and pushes the changes that have been made to an feuser record to the CardDAV server.