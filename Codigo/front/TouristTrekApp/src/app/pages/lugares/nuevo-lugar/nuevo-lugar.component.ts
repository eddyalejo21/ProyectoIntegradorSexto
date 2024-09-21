import { Component, inject } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { ILugar } from 'src/app/interfaces/lugares';
import { ComerciosService } from 'src/app/services/comercios.service';
import { LugaresService } from 'src/app/services/lugares.service';

@Component({
  selector: 'app-nuevo-lugar',
  standalone: true,
  imports: [FormsModule],
  templateUrl: './nuevo-lugar.component.html',
  styleUrl: './nuevo-lugar.component.scss'
})
export class NuevoLugarComponent {

  private lugaresService = inject(LugaresService);
  private navegacion = inject(Router);
  private ruta = inject(ActivatedRoute);

  titulo: string = "Insertar Lugar";
  tipoAccion = "Registrar";
  id_lugar: number = 0;
  nombre: string = "";
  latitud: number = 0.0;
  longitud: number = 0.0;

  ngOnInit(): void {
    this.id_lugar = parseInt(this.ruta.snapshot.paramMap.get('id'));
    console.log('Id de lugar', this.id_lugar);

    if (this.id_lugar > 0) {
      this.lugaresService.uno(this.id_lugar).subscribe((lugar) => {
        console.log(lugar);
        this.nombre = lugar.nombre;
        this.latitud = lugar.latitud;
        this.longitud = lugar.longitud;

        this.titulo = 'Actualizar Lugar';
        this.tipoAccion = 'Actualizar';
      });
    }
  }

  registrar() {
    const lugar = {
      id_lugar: this.id_lugar,
      nombre: this.nombre,
      latitud: this.latitud,
      longitud: this.longitud
    };

    if (this.id_lugar > 0) {

      this.lugaresService.actualizar(lugar).subscribe((data) => {
        console.log('Respuesta Actualiza', data);
        this.navegacion.navigate(['/lugares']);
      })

    } else {

      this.lugaresService.insertar(lugar).subscribe((data) => {
        console.log('Respuesta Graba', data);
        if (parseInt(data) > 1) {
          alert('Grabado con exito');
          this.navegacion.navigate(['/lugares']);
        } else {
          alert('Error al grabar');
        }
      })

    }

    
  }
}
