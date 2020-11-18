import Vue from 'vue'

import Navbar from './components/Navbar'
Vue.component('Navbar', Navbar)

import HeaderComp from './components/HeaderComp'
Vue.component('HeaderComp', HeaderComp)

import BtnCreate from './components/form/BtnCreate'
Vue.component('BtnCreate', BtnCreate)

import BtnUpdate from './components/form/BtnUpdate'
Vue.component('BtnUpdate', BtnUpdate)

import UploadImage from './components/form/UploadImage'
Vue.component('UploadImage', UploadImage)


// datatables
import dataTable from './components/dataTables/Index'
Vue.component('dataTable', dataTable)

import Actions from './components/dataTables/buttons/Actions'
Vue.component('menu-actions', Actions)

import CreatedBy from './components/dataTables/buttons/CreatedBy'
Vue.component('CreatedBy', CreatedBy)

import BtnEdit from './components/dataTables/buttons/EditRow'
Vue.component('BtnEdit', BtnEdit)

import BtnDelete from './components/dataTables/buttons/DeleteRow'
Vue.component('BtnDelete', BtnDelete)

import BtnRestore from './components/dataTables/buttons/RestoreRow'
Vue.component('BtnRestore', BtnRestore)

import BtnForceDelete from './components/dataTables/buttons/ForceDeleteRow'
Vue.component('BtnForceDelete', BtnForceDelete)

import BtnViewProfile from './components/dataTables/buttons/ViewProfile'
Vue.component('BtnViewProfile', BtnViewProfile)

// filters
import CreatedBySelect from './components/dataTables/filters/CreatedBySelect'
Vue.component('CreatedBySelect', CreatedBySelect)

import LeadStatusesSelect from './components/dataTables/filters/LeadStatusesSelect'
Vue.component('LeadStatusesSelect', LeadStatusesSelect)

// global
import CreateMeetingModal from './components/modals/CreateMeetingModal'
Vue.component('CreateMeetingModal', CreateMeetingModal)

import MeetingStatusesSelect from './components/dataTables/filters/MeetingStatusesSelect'
Vue.component('MeetingStatusesSelect', MeetingStatusesSelect)
