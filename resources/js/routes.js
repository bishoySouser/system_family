import Home from './pages/Home'
import Individual from './pages/Individual'
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
        meta: {
            secure: true
        }
    },
    {
        path: '/individual',
        component: Individual,
        name: 'individual',
        meta: {
            secure: true
        }
    },
    {
        path: '/family',
        component: Family,
        name: 'family',
        meta: {
            secure: true
        }
    },
    {
        path: '/family/New',
        component: AddFamily,
        name: 'add-family'
    },
    {
        path: '/import-excel',
        component: ImportExecl,
        name: 'import-excel'
    },
    {
        path: '/export-excel',
        component: ExportExcel,
        name: 'export-excel'
    },
    {
        path: '/login',
        component: Login,
        name: 'login',
        meta: {
            secure: false
        }
        
    }

]