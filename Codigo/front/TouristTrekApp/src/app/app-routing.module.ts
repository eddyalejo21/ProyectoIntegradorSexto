// angular import
import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

// Project import
import { AdminComponent } from './theme/layouts/admin-layout/admin-layout.component';
import { GuestComponent } from './theme/layouts/guest/guest.component';

const routes: Routes = [
  {
    path: '',
    component: AdminComponent,
    children: [
      {
        path: '',
        redirectTo: '/dashboard/default',
        pathMatch: 'full'
      },
      {
        path: 'dashboard/default',
        loadComponent: () => import('./demo/default/dashboard/dashboard.component').then((c) => c.DefaultComponent)
      },
      {
        path: 'typography',
        loadComponent: () => import('./demo/ui-component/typography/typography.component')
      },
      {
        path: 'color',
        loadComponent: () => import('./demo/ui-component/ui-color/ui-color.component')
      },
      {
        path: 'sample-page',
        loadComponent: () => import('./demo/other/sample-page/sample-page.component')
      },
      {
        path: 'comercios',
        loadComponent: () => import('./pages/comercios/comercios.component').then((m) => m.ComerciosComponent)
      },
      {
        path: 'nuevocomercio',
        loadComponent: () => import('./pages/comercios/nuevo-comercio/nuevo-comercio.component').then((m) => m.NuevoComercioComponent),
      },
      {
        path: 'editar-comercio/:id',
        loadComponent: () => import('./pages/comercios/nuevo-comercio/nuevo-comercio.component').then((m) => m.NuevoComercioComponent),
      },
      {
        path: 'actividades',
        loadComponent: () => import('./pages/actividades/actividades.component').then((m) => m.ActividadesComponent)
      },
      {
        path: 'nuevaactividad',
        loadComponent: () => import('./pages/actividades/nueva-actividad/nueva-actividad.component').then((m) => m.NuevaActividadComponent),
      },
      {
        path: 'editar-actividad/:id',
        loadComponent: () => import('./pages/actividades/nueva-actividad/nueva-actividad.component').then((m) => m.NuevaActividadComponent),
      },
      {
        path: 'lugares',
        loadComponent: () => import('./pages/lugares/lugares.component').then((m) => m.LugaresComponent)
      },
      {
        path: 'nuevolugar',
        loadComponent: () => import('./pages/lugares/nuevo-lugar/nuevo-lugar.component').then((m) => m.NuevoLugarComponent),
      },
      {
        path: 'editar-lugar/:id',
        loadComponent: () => import('./pages/lugares/nuevo-lugar/nuevo-lugar.component').then((m) => m.NuevoLugarComponent),
      },
      {
        path: 'actividad-comercio',
        loadComponent: () => import('./pages/actividad-comercio/actividad-comercio.component').then((m) => m.ActividadComercioComponent)
      },
      {
        path: 'nuevoactividadcomercio',
        loadComponent: () => import('./pages/actividad-comercio/nuevo-actividad-comercio/nuevo-actividad-comercio.component').then((m) => m.NuevoActividadComercioComponent),
      },
      {
        path: 'editar-lugar/:id',
        loadComponent: () => import('./pages/actividad-comercio/nuevo-actividad-comercio/nuevo-actividad-comercio.component').then((m) => m.NuevoActividadComercioComponent),
      }
    ]
  },
  {
    path: '',
    component: GuestComponent,
    children: [
      {
        path: 'login',
        loadComponent: () => import('./demo/authentication/login/login.component')
      },
      {
        path: 'register',
        loadComponent: () => import('./demo/authentication/register/register.component')
      }
    ]
  }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule {}
