import { Component, inject, OnInit } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { ActividadesService } from 'src/app/services/actividades.service';

@Component({
  selector: 'app-nueva-actividad',
  standalone: true,
  imports: [FormsModule],
  templateUrl: './nueva-actividad.component.html',
  styleUrl: './nueva-actividad.component.scss'
})
export class NuevaActividadComponent implements OnInit {

  private actividadesService = inject(ActividadesService);
  private navegacion = inject(Router);
  private ruta = inject(ActivatedRoute);
  

  titulo: string = "Insertar Actividad";
  tipoAccion = "Registrar";
  id_actividad: number = 0;
  nombre: string = "";
  id_tipo_actividad: number = 1;

  ngOnInit(): void {
    this.id_actividad = parseInt(this.ruta.snapshot.paramMap.get('id'));
    console.log('Id de actividad', this.id_actividad);

    if (this.id_actividad > 0) {
      this.actividadesService.uno(this.id_actividad).subscribe((comercio) => {
        console.log(comercio);
        this.nombre = comercio.nombre;
        this.id_tipo_actividad = comercio.id_tipo_actividad;
        this.titulo = 'Actualizar Comercio';
        this.tipoAccion = 'Actualizar';
      });
    }
  }

  registrar() {
    const actividad = {
      id_actividad: this.id_actividad,
      nombre: this.nombre,
      id_tipo_actividad: this.id_tipo_actividad
    };

    if (this.id_actividad > 0) {

      this.actividadesService.actualizar(actividad).subscribe((data) => {
        console.log('Respuesta Actualiza', data);
        this.navegacion.navigate(['/actividades']);
      })

    } else {

      this.actividadesService.insertar(actividad).subscribe((data) => {
        console.log('Respuesta Graba', data);
        if (parseInt(data) > 1 || data != null) {
          alert('Grabado con exito');
          this.navegacion.navigate(['/actividades']);
        } else {
          alert('Error al grabar');
        }
      })

    }

    
  }

}
