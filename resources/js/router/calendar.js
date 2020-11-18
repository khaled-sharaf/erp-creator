import IndexModel from '../views/calendar/Index'
import Agenda from '../views/calendar/Agenda'
import TrashedEvents from '../views/calendar/TrashedEvents'

// import Calendar from '../views/calendar/Calendar'

const routes = [
    ////////////////// calendar routes ///////////////////
    {
        path: 'calendar',
        name: 'calendar-model',
        component: IndexModel,
        meta: {
            permission: 'show-module-calendar'
        },
        children: [
          /* ==================== Agenda ==================== */
          {
            path: 'agenda',
            name: 'agenda',
            meta: {
                permission: 'calendar'
            },
            component: Agenda
          },
          /* ==================== Trashed Events ==================== */
          {
            path: 'agenda/trashed',
            name: 'agenda-trashed',
            meta: {
                permission: 'trashed-calendar'
            },
            component: TrashedEvents
          },

          /* ==================== Calendar ==================== */
          // {
          //   path: 'calendar',
          //   name: 'calendar',
          //   meta: {
          //       permission: 'calendar'
          //   },
          //   component: Calendar
          // },
        ]
    },
]

export default routes
