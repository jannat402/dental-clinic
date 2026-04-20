<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/seleccionarcita.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{asset('js/panelCitas.js')}}"></script>
</head>
<body>
    <main>
        <h1>Bievenido a dental clinic</a></h1>
        <p> Aquí puede reservar cita. Para cualquier problema o para agendar cita por teléfono, llama al 666666666</p>
        <form action="{{route('citaseleccionada')}}">
            <fieldset>
                <select name="nombredoctor" id="nombredoctor">
                    <option value="">Seleccione un doctor</option>
                </select>
                <select name="tratamiento" id="tratamiento">
                </select>
                <input type="hidden" name="duracion_tratamiento" id="duracion_tratamiento">
                <input type="hidden" name="precio_tratamiento" id="precio_tratamiento">
                <p>Si no sabe qué necesita, puede solictar consulta inicial, y se le hará el tratamiento correspondiente en clínica o le asesorá nuestro dentista. Consulta nuestro blog de salud dental y el apartado de nuestros servicios para más información</p>
            </fieldset>
            <fieldset>
                <div id="mes">{{$mesNombre}}</div>
                <table id="tablahoras">
                    <tr>
                        <th>Lunes</th>
                        <th>Martes</th>
                        <th>Miercoles</th>
                        <th>Jueves</th>
                        <th>Viernes</th>
                        <th>Sabado</th>
                        <th>Domingo</th>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>1</td>
                        <td>2</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
                        <td>6</td>
                        <td>7</td>
                        <td>8</td>
                        <td>9</td>
                    </tr>
                        <td>10</td>
                        <td>11</td>
                        <td>12</td>
                        <td class="festivo">13</td>
                        <td>14</td>
                        <td>15</td>
                        <td>16</td>
                    </tr>
                    </tr>
                        <td>17</td>
                        <td>18</td>
                        <td>19</td>
                        <td>20</td>
                        <td>21</td>
                        <td>22</td>
                        <td>23</td>
                    </tr>
                    </tr>
                        <td>24</td>
                        <td>25</td>
                        <td>26</td>
                        <td>27</td>
                        <td>28</td>
                        <td>29</td>
                        <td>30</td>
                    </tr>
                </table>
<div id="horas" style="display: none;">
                    <h2 id="tituloHoras">Seleccione una franquicia</h2>
                    <div id="listadohoras">
                    </div>
                    <div id="botonReservar" style="display: none; margin-top: 20px;">
                        <input type="submit" value="Reservar cita">
                    </div>
                </div>
                </div>

                <input type="hidden" name="fecha" id="fecha">
            </fieldset>
    
        </form>
    </main>
</body>
</html>