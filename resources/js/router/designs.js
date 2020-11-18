import IndexModel from '../views/designs/Index'

// Logos
import Logos from '../views/designs/logos/Index'
import LogosProfile from '../views/designs/logos/Profile'
import SocialMedia from '../views/designs/social_media/Index'
import SocialMediaProfile from '../views/designs/social_media/Profile'
import Printing from '../views/designs/printing/Index'
import PrintingProfile from '../views/designs/printing/Profile'

const routes = [
    ////////////////// designs routes ///////////////////
    {
        path: 'designs',
        name: 'designs-model',
        component: IndexModel,
        meta: {
            permission: 'show-module-designs'
        },
        children: [
            /* ==================== logos ==================== */
            {
                path: 'logos',
                name: 'logos',
                meta: {
                    permission: 'index-logos'
                },
                component: Logos
            },
            {
              path: 'logos/:id/profile',
              name: 'logos-profile',
              meta: {
                  permission: 'profile-logos'
              },
              component: LogosProfile,
              props: true
            },
            {
              path: 'social-media',
              name: 'social-media',
              meta: {
                  permission: 'index-social-media'
              },
              component: SocialMedia,
            },
            {
              path: 'social-media/:id/profile',
              name: 'social-media-profile',
              meta: {
                  permission: 'profile-social-media'
              },
              component: SocialMediaProfile,
              props: true
            },
            {
              path: 'printing',
              name: 'printing',
              meta: {
                  permission: 'index-printing'
              },
              component: Printing,
            },
            {
              path: 'printing/:id/profile',
              name: 'printing-profile',
              meta: {
                  permission: 'profile-printing'
              },
              component: PrintingProfile,
            },
        ]
    },
]

export default routes
