<div class="modal   fade" id={{"modifier".$consultation->id}} tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
<form method="POST " enctype="multipart/form-data"  id={{"item".$consultation->id}} action="{{route('Consultations.update',$consultation->id)}}" class="AjouterForm p-4  m-3" style="background-color: #fff;border-radius:5px" >
    @method("PUT")
    @csrf
        <div class="row">

            <div class="col-6">

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Numéro Consultation</label>
                    <div class="d-flex" >
                        <input  value="{{$consultation->NumeroConsultation}}"  required type="text"  name="NumeroConsultation" class="form-control" id="exampleFormControlInput1" >
                        <button  type="button" class="btn btn-success"  id="generate" >
                            <i class="fa-solid fa-lightbulb"></i>
                        </button>
                    </div>
                </div>
            </div>
    <div class="col-6">

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Patient</label>
            <select required name="patient_id"  id="patientm" class="form-select " aria-label=".form-select-lg example">
                <option value="" selected>Choisir Patient</option>
                @foreach ($patients as $patient )
                <option value="{{$patient->id}}"  @selected($consultation->patient_id===$patient->id) >{{$patient->Nom}} - {{$patient->Prenom}} - {{$patient->Numero}} </option>
                @endforeach
              </select>
        </div>
    </div>

    <div class="col-6">

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Object</label>
            <textarea  required name="Objet" class="form-control" id="exampleTextarea" rows="4">{{$consultation->Objet}}</textarea>
        </div>
    </div>

    <div class="col-6">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Observation</label>
            <textarea required name="Observation" class="form-control" id="exampleTextarea" rows="4">{{$consultation->Observation}}</textarea>
        </div>
    </div>

          <div class="col-6">

              <div class="mb-3">
                  <label for="exampleFormControlInput1" class="form-label">Type consultation</label>
                  <select required name="TypeCosultation" id="operation" class="form-select " aria-label=".form-select-lg example">
                    <option value="">Choisir Patient</option>
                    <option @selected($consultation->TypeCosultation=='Consultationgénéral') value="Consultationgénéral ">Consultation général  </option>
                    <option  @selected($consultation->TypeCosultation=='operation') value="operation ">Une Opération  </option>
                  </select>
                </div>
        </div>


            <div class="col-6 hide  pmedcinm ">
                <label for="exampleFormControlInput1" class="form-label">Date </label>
                <input required id="dateconsul"  type="date" name="Date_consultation"  required class="form-control" id="exampleFormControlInput1" >
            </div>

            <div class="col-6 hide pdate">
                <label for="exampleFormControlInput1" class="form-label">Time</label>
            <select required class="form-select "  name="time" aria-label=".form-select-lg example">
                <option selected>Choisir Time</option>
              </select>
             </div>



            <div class="col-6 op hide">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Equipe</label>
                    <div class="d-flex" >
                    <select name="equipe_id" id="equipe" class="form-select " aria-label=".form-select-lg example">
                        <option   selected>Choisir une Equipe</option>
                        @foreach ($equipes as $equipe )
                        <option @selected($consultation?->operation?->equipe_id==$equipe->id) value="{{$equipe?->id}}"> - {{$equipe?->nom}} </option>
                        @endforeach
                    </select>
                    <button  type="button" class="btn btn-warning" ><i class="fa-solid fa-plus"></i></button>
                    </div>
                </div>
            </div>




            <div class="col-6  op hide">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Bloc operation</label>
                    <select name="blocoperation_id" class="form-select " aria-label=".form-select-lg example">
                        <option selected>Choisir un Block</option>
                        @foreach ($blocs as $bloc )
                        <option  @selected($consultation->operation->blocoperation_id==$bloc->id) value="{{$bloc->id}}"> - {{$bloc->id}} </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-12 einfo ">

            </div>

            <div class="col-6 op hide">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Date de Debut</label>
                    <input  value="{{$consultation?->operation?->DateDebut}}" type="datetime-local" name="DateDebut"   class="form-control" id="exampleFormControlInput1" >
                </div>
            </div>

            <div class="col-6 op hide">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Date de Fin</label>
                    <input value="{{$consultation?->operation?->DateFin}}"   type="datetime-local" name="DateFin"   class="form-control" id="exampleFormControlInput1" >
                </div>
            </div>

            <div class="mb-3 op hide">
                <label for="exampleFormControlInput1" class="form-label">Operation observation</label>
                <textarea name="ObservationOperation"  class="form-control" id="exampleTextarea" rows="4">{{$consultation?->operation?->Observation}}</textarea>
            </div>
        </div>
          <button type="submit" class="btn btn-danger ">Enregistrer</button>
        </form>
        </div>
    </div>
</div>







         <script>
             var equipesm ={{ Js::from($equipes)}}
             var datem ={{ Js::from($consultation->Date_consultation)}}
             console.log(datem);
            var patientsm ={{ Js::from($patients)}}
            var patientselectm = document.querySelectorAll('#patientm')
            console.log(patientselectm);
            var inputsdatem = document.querySelectorAll('.pmedcinm')

            var pselect;
            inputsdatem.forEach(item=>{
                item.classList.remove('hide')
                item.querySelector('input').value=datem.split(' ')[0]
            })

            pselect = patientsm.find(e=>e.id==patientselectm.value)
            patientselectm.forEach( patient => patient.onchange=(e)=>{
                let idp = e.target.options[e.target.selectedIndex].value
                if(idp){
                    inputsdatem.forEach(item=>item.classList.remove('hide'))
                }
                else{
                    inputsdatem.forEach(item=>item.classList.add('hide'))
                }
            })



            var btngenererm = document.querySelectorAll('#generate')
            btngenererm.forEach(btn =>btn.onclick=(e)=>{
                let data = ['A','B','C',1,2,3,'D','E','F','H','J',5,6,'K','L','M','V',4,,7,9]
                let generatedvalue = data.sort(()=>0.75-Math.random()).splice(0,10).join('')
                let input = e.target.closest('div').firstElementChild
                input.value=generatedvalue
            })



            var operationm = document.querySelectorAll('#operation');
            //var operationsInputs=document.querySelectorAll('.op')
            operationm.forEach(operation=>{
                if(operation.value.trim()=='operation'){
                    operation.closest('form').querySelectorAll('.op').forEach(operation=>{operation.classList.remove('hide')
                operation.setAttribute('required','required')
                })

                }
            })


            operationm.forEach(operation =>operation.onchange=(e=>{
                let operationsInputs=e.target.closest('form').querySelectorAll('.op')

                if(e.target.options[e.target.selectedIndex].value.trim()=='operation'){
                    operationsInputs.forEach(operation=>{operation.classList.remove('hide')
                operation.setAttribute('required','required')
                })

                }
                else{
                operationsInputs.forEach(operation=>{operation.classList.add('hide')
                operation.removeAttribute('required');
            })
                }
            })
            )

            var equipem = document.querySelector('#equipe')
            if(equipem){

                equipem.onchange=(e=>{
                    let idequipe = e.target.options[e.target.selectedIndex].value.trim()
               let result =  equipesm.find(eq=>eq.id==idequipe)
               let targetdiv = e.target.closest('div').nextElementSibling
               let medcin=[];
               let infermiere=[];
               let einfo = document.querySelector('.einfo')
               result.equipemember.forEach(e=>{
                if(e?.medecin){
                    medcin.push(e.medecin)
                }
                if(e?.infermiere){
                    infermiere.push(e.infermiere)
                }
            } )
               einfo.innerHTML=`
               <textarea readonly class='form-control' > ${medcin.map(e=>`- medcin : ${ e.Matricule } ${ e.Nom } `)} </textarea>
               `

            })
        }
        </script>