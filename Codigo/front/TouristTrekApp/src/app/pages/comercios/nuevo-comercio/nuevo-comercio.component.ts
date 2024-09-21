import { Component, inject, OnInit } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { cloneSVG } from '@ant-design/icons-angular';
import { ComerciosService } from 'src/app/services/comercios.service';

@Component({
  selector: 'app-nuevo-comercio',
  standalone: true,
  imports: [FormsModule],
  templateUrl: './nuevo-comercio.component.html',
  styleUrl: './nuevo-comercio.component.scss'
})
export class NuevoComercioComponent implements OnInit {

  private comerciosService = inject(ComerciosService);
  private navegacion = inject(Router);
  private ruta = inject(ActivatedRoute);

  titulo: string = "Insertar Comercio";
  tipoAccion = "Registrar";
  id_comercio: number = 0;
  nombre: string = "";
  direccion: string = "";
  id_estado: number = 1;
  latitud: number = 0.0;
  longitud: number = 0.0;

  ngOnInit(): void {
    this.id_comercio = parseInt(this.ruta.snapshot.paramMap.get('id'));
    console.log('Id de comercio', this.id_comercio);

    if (this.id_comercio > 0) {
      this.comerciosService.uno(this.id_comercio).subscribe((comercio) => {
        console.log(comercio);
        this.nombre = comercio.nombre;
        this.direccion = comercio.direccion;
        this.latitud = comercio.latitud;
        this.longitud = comercio.longitud;

        this.titulo = 'Actualizar Comercio';
        this.tipoAccion = 'Actualizar';
      });
    }
  }

  registrar() {
    const comercio = {
      id_comercio: this.id_comercio,
      nombre: this.nombre,
      direccion: this.direccion,
      id_estado: this.id_estado,
      latitud: this.latitud,
      longitud: this.longitud
    };

    if (this.id_comercio > 0) {

      this.comerciosService.actualizar(comercio).subscribe((data) => {
        console.log('Respuesta Actualiza', data);
        this.navegacion.navigate(['/comercios']);
      })

    } else {

      this.comerciosService.insertar(comercio).subscribe((data) => {
        console.log('Respuesta Graba', data);
        if (parseInt(data) > 1) {
          alert('Grabado con exito');
          this.navegacion.navigate(['/comercios']);
        } else {
          alert('Error al grabar');
        }
      })
    }
  }

}
