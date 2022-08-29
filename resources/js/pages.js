import { defineAsyncComponent } from 'vue'

const pages = {
    'login-card': defineAsyncComponent(() => import('./views/auth/Login.vue')),
    'logout-modal': defineAsyncComponent(() => import('./views/auth/LogoutModal.vue')),
    
    'users-index': defineAsyncComponent(() => import('./views/pages/users/Index.vue')),
    'users-form': defineAsyncComponent(() => import('./views/pages/users/Form.vue')),

    'custom-editor': defineAsyncComponent(() => import('./views/pages/custom/CustomRTEDemo.vue')),
    
    'dashboard': defineAsyncComponent(() => import('./views/pages/dashboard/Dashboard.vue')),
    
    'blogs-index': defineAsyncComponent(() => import('./views/pages/blogs/Index.vue')),
    'blogs-form': defineAsyncComponent(() => import('./views/pages/blogs/Form.vue')),
}

export default pages;

