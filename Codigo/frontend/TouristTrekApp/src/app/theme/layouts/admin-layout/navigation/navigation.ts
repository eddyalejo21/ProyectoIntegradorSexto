export interface NavigationItem {
  id: string;
  title: string;
  type: 'item' | 'collapse' | 'group';
  translate?: string;
  icon?: string;
  hidden?: boolean;
  url?: string;
  classes?: string;
  groupClasses?: string;
  exactMatch?: boolean;
  external?: boolean;
  target?: boolean;
  breadcrumbs?: boolean;
  children?: NavigationItem[];
  link?: string;
  description?: string;
  path?: string;
}

export const NavigationItems: NavigationItem[] = [
  {
    id: 'dashboard',
    title: 'Dashboard',
    type: 'group',
    icon: 'icon-navigation',
    children: [
      {
        id: 'default',
        title: 'Default',
        type: 'item',
        classes: 'nav-item',
        url: '/dashboard/default',
        icon: 'dashboard',
        breadcrumbs: false
      }
    ]
  },
  {
    id: 'authentication',
    title: 'Authentication',
    type: 'group',
    icon: 'icon-navigation',
    children: [
      {
        id: 'login',
        title: 'Login',
        type: 'item',
        classes: 'nav-item',
        url: '/login',
        icon: 'login',
        target: true,
        breadcrumbs: false
      },
      {
        id: 'register',
        title: 'Register',
        type: 'item',
        classes: 'nav-item',
        url: '/register',
        icon: 'profile',
        target: true,
        breadcrumbs: false
      }
    ]
  },
  {
    id: 'utilities',
    title: 'UI Components',
    type: 'group',
    icon: 'icon-navigation',
    children: [
      {
        id: 'clientes',
        title: 'Clientes',
        type: 'item',
        classes: 'nav-item',
        url: '/clientes',
        icon: 'font-size'
      },
      {
        id: 'proveedores',
        title: 'Proveedores',
        type: 'item',
        classes: 'nav-item',
        url: '/proveedores',
        icon: 'font-size'
      },
      {
        id: 'actividades',
        title: 'Actividades',
        type: 'item',
        classes: 'nav-item',
        url: '/actividades',
        icon: 'bg-colors'
      },
      {
        id: 'actividades-proveedor',
        title: 'Actividades Proveedor',
        type: 'item',
        classes: 'nav-item',
        url: '/actividades-proveedor',
        icon: 'bg-colors'
      },
      {
        id: 'tipo-cliente',
        title: 'Tipo de Cliente',
        type: 'item',
        classes: 'nav-item',
        url: '/tipo-cliente',
        icon: 'bg-colors'
      },
      {
        id: 'tipo-actividad',
        title: 'Tipo de Actividad',
        type: 'item',
        classes: 'nav-item',
        url: '/tipo-actividad',
        icon: 'bg-colors'
      },
      {
        id: 'medio-contacto',
        title: 'Medios de Contacto',
        type: 'item',
        classes: 'nav-item',
        url: '/medio-contacto',
        icon: 'bg-colors'
      }
      
    ]
  },

  
];
