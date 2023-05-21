package com.example.gym_app.activity;

import androidx.appcompat.app.AppCompatActivity;
import java.util.Calendar;

import android.app.DatePickerDialog;
import android.app.Dialog;
import android.app.TimePickerDialog;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.TimePicker;
import android.widget.Toast;

import com.example.gym_app.R;
import com.example.gym_app.model.ApiResponse;
import com.example.gym_app.model.Session;
import com.example.gym_app.model.UserData;
import com.example.gym_app.network.ApiClient;
import com.example.gym_app.network.UserService;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class EditSessionActivity extends AppCompatActivity {


    private Calendar calendar;

    private int year, month, day;

    Button submit;
    EditText name;
            TextView coachName, date , start_at, end_at;

    Session session;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_edit_session);
        name = (EditText) findViewById(R.id.editText1);
        coachName = (TextView) findViewById(R.id.editText2);
        date = (TextView) findViewById(R.id.editText3);
        start_at = (TextView) findViewById(R.id.editText4);
        end_at = (TextView) findViewById(R.id.editText5);
        submit = (Button) findViewById(R.id.button);

        calendar = Calendar.getInstance();




        UserData x = UserData.getInstance();
        String   token = x.token;


        session = (Session) getIntent().getSerializableExtra("session");
        date.setText(session.getDay());
        name.setText(session.getName());
        coachName.setText(session.getCoach_name());
        start_at.setText(session.getStarts_at());
        end_at.setText(session.getFinishes_at());

        calendar = Calendar.getInstance();
        year = calendar.get(Calendar.YEAR);
        month = calendar.get(Calendar.MONTH);
        day = calendar.get(Calendar.DAY_OF_MONTH);

        showDate(year, month+1, day);


        submit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                UserService service = ApiClient.getRetrofitInstance(token).create(UserService.class);

                session.setName(name.getText().toString());
                session.setDay(date.getText().toString());

                session.setStarts_at(start_at.getText().toString());
                session.setFinishes_at(end_at.getText().toString());

                System.out.println("Nom de la séance: " + session.getName());
                System.out.println("Date de la séance: " + session.getDay());
                System.out.println("Heure de début: " + session.getStarts_at());
                System.out.println("Heure de fin: " + session.getFinishes_at());



                Call<ApiResponse> call = service.updateSession(session.getId(),session);
                call.enqueue(new Callback<ApiResponse>() {
                    @Override
                    public void onResponse(Call<ApiResponse> call, Response<ApiResponse> response) {
                        Toast.makeText(EditSessionActivity.this, response.body().getMessage(), Toast.LENGTH_SHORT).show();
                        if(response.body().getMessage().contains("success")) {
                            System.out.println(response.body().getMessage());
                            startActivity(new Intent(EditSessionActivity.this, SessionsActivity.class).putExtra("token", token));
                            EditSessionActivity.this.finish();
                        }
                    }
                    @Override
                    public void onFailure(Call<ApiResponse> call, Throwable t) {

                        Toast.makeText(EditSessionActivity.this, "Une erreur s'est produite... Veuillez réessayer plus tard !", Toast.LENGTH_SHORT).show();
                    }
                });


            }
        });

        date.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                setDate(v);
            }
        });

                start_at.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    // on below line we are getting the
                    // instance of our calendar.
                    final Calendar c = Calendar.getInstance();

                    // on below line we are getting our hour, minute.
                    int hour = c.get(Calendar.HOUR_OF_DAY);
                    int minute = c.get(Calendar.MINUTE);

                    // on below line we are initializing our Time Picker Dialog
                    TimePickerDialog timePickerDialog = new TimePickerDialog(EditSessionActivity.this,
                            new TimePickerDialog.OnTimeSetListener() {
                                @Override
                                public void onTimeSet(TimePicker view, int hourOfDay,
                                                      int minute) {
                                    // on below line we are setting selected time
                                    // in our text view.
                                    start_at.setText(hourOfDay + ":" + minute);
                                }
                            }, hour, minute, false);
                    // at last we are calling show to
                    // display our time picker dialog.
                    timePickerDialog.show();
                }
            });

        end_at.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // on below line we are getting the
                // instance of our calendar.
                final Calendar c = Calendar.getInstance();

                // on below line we are getting our hour, minute.
                int hour = c.get(Calendar.HOUR_OF_DAY);
                int minute = c.get(Calendar.MINUTE);

                // on below line we are initializing our Time Picker Dialog
                TimePickerDialog timePickerDialog = new TimePickerDialog(EditSessionActivity.this,
                        new TimePickerDialog.OnTimeSetListener() {
                            @Override
                            public void onTimeSet(TimePicker view, int hourOfDay,
                                                  int minute) {
                                // on below line we are setting selected time
                                // in our text view.
                                end_at.setText(hourOfDay + ":" + minute);
                            }
                        }, hour, minute, false);
                // at last we are calling show to
                // display our time picker dialog.
                timePickerDialog.show();
            }
        });


    }


    @SuppressWarnings("deprecation")
    public void setDate(View view) {
        showDialog(999);
        Toast.makeText(getApplicationContext(), "ca",
                Toast.LENGTH_SHORT)
                .show();
    }

    @Override
    protected Dialog onCreateDialog(int id) {
        // TODO Auto-generated method stub
        if (id == 999) {
            return new DatePickerDialog(this,
                    myDateListener, year, month, day);
        }
        return null;
    }

    private DatePickerDialog.OnDateSetListener myDateListener = new
            DatePickerDialog.OnDateSetListener() {
                @Override
                public void onDateSet(DatePicker arg0,
                                      int arg1, int arg2, int arg3) {
                    // TODO Auto-generated method stub
                    // arg1 = year
                    // arg2 = month
                    // arg3 = day
                    showDate(arg1, arg2+1, arg3);
                }
            };

    private void showDate(int year, int month, int day) {
        date.setText(new StringBuilder().append(year).append("-")
                .append(month).append("-").append(day));
    }
}

