import Home from './pages/Home'
import Individual from './pages/Individual'
import IndividualEdit from './pages/edit/IndividualEdit'
import FamilyEdit from './pages/edit/FamilyEdit'
import Family from './pages/Family'
import AddFamily from './pages/family/FamilyAdd'
import ImportExecl from './pages/ImportExecl'
import ExportExcel from './pages/ExportExcel'
import Login from './pages/Login'


export default [
    {
        path: '/',
        component: Home,
        name: 'home',
        alias: '/home',
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/individual',
        component: Individual,
        name: 'individual',
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/individual/one/:individualId',
        component: IndividualEdit,
        name: 'individual_edit',
        props: true,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/family/one/:familyId',
        component: FamilyEdit,
        name: 'family',
        props: true,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/family',
        component: Family,
        name: 'family',
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/family/New',
        component: AddFamily,
        name: 'add-family',
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/import-excel',
        component: ImportExecl,
        name: 'import-excel',
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/export-excel',
        component: ExportExcel,
        name: 'export-excel',
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/login',
        component: Login,
        name: 'login',
        meta: {
            guest: true
        }
    }

]