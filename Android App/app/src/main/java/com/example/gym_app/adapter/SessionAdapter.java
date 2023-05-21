package com.example.gym_app.adapter;

import android.content.Intent;
import android.view.LayoutInflater;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.RecyclerView;

import com.example.gym_app.R;


import android.view.ViewGroup;


import android.content.Context;
import android.widget.Toast;

import com.example.gym_app.activity.EditSessionActivity;
import com.example.gym_app.activity.SessionsActivity;
import com.example.gym_app.model.ApiResponse;
import com.example.gym_app.model.Session;
import com.example.gym_app.model.UserData;
import com.example.gym_app.network.ApiClient;
import com.example.gym_app.network.UserService;

import java.util.List;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class SessionAdapter  extends RecyclerView.Adapter<SessionAdapter.SessionViewHolder> {


    private List<Session> dataList;
    private Context context;
    private AppCompatActivity activity;
    private String token;
    public SessionAdapter(Context context,List<Session> dataList,String token,AppCompatActivity activity){
        this.context = context;
        this.dataList = dataList;
        this.token = token;
        this.activity=activity;
    }

    class SessionViewHolder extends RecyclerView.ViewHolder {

        public final View mView;

        TextView txtTitle;
        TextView coachName;
        TextView day;
        TextView startAt;
        TextView endAt;
        Button btn_edit,btn_delete, btn_reserve;
        private ImageView coverImage;

        SessionViewHolder(View itemView) {
            super(itemView);
            mView = itemView;

            txtTitle = mView.findViewById(R.id.title);
            coachName = mView.findViewById(R.id.coach_name);
            day = mView.findViewById(R.id.day);
            startAt = mView.findViewById(R.id.session_start);
            endAt = mView.findViewById(R.id.session_end);
            btn_edit = mView.findViewById(R.id.edit);
            btn_delete = mView.findViewById(R.id.delete);
            btn_reserve = mView.findViewById(R.id.reserve);
          //  coverImage = mView.findViewById(R.id.coverImage);
        }
    }

    @Override
    public SessionViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        LayoutInflater layoutInflater = LayoutInflater.from(parent.getContext());
        View view = layoutInflater.inflate(R.layout.session_raw, parent, false);

        return new SessionViewHolder(view);
    }


    @Override
    public void onBindViewHolder(SessionViewHolder holder, int position) {

        UserData x = UserData.getInstance();
        String   role = x.role;


        holder.txtTitle.setText("Nom: "+dataList.get(position).getName());
        holder.coachName.setText("Nom de l'entraîneur:  "+dataList.get(position).getCoach_name());
        holder.day.setText("Date de la séance: "+dataList.get(position).getDay());
       holder.startAt.setText("Heure de début: "+dataList.get(position).getStarts_at().toString());
       holder.endAt.setText("Heure de fin: "+dataList.get(position).getFinishes_at().toString());

      if(role.contains("user")){

          holder.btn_edit.setVisibility(View.GONE);
          holder.btn_delete.setVisibility(View.GONE);

      } else{ holder.btn_reserve.setVisibility(View.GONE);}


        holder.btn_delete.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                UserService service = ApiClient.getRetrofitInstance(token).create(UserService.class);

                Call<ApiResponse> call = service.deleteSession(dataList.get(position).getId());
                call.enqueue(new Callback<ApiResponse>() {



                    @Override
                    public void onResponse(Call<ApiResponse> call, Response<ApiResponse> response) {

                        Toast.makeText(context, response.body().getMessage(), Toast.LENGTH_SHORT).show();


                        if(response.body().getMessage().contains("success")) {

                           context.startActivity(new Intent(context, SessionsActivity.class).putExtra("token", token));
                         activity.finish();
                      //     Intent refresh = new Intent(context, SessionsActivity.class);
                       //                 context.startActivity(refresh);

                    }
                    }

                    @Override
                    public void onFailure(Call<ApiResponse> call, Throwable t) {

                        Toast.makeText(context, "Une erreur s'est produite... Veuillez réessayer plus tard !", Toast.LENGTH_SHORT).show();
                    }
                });


            }
        });



        holder.btn_reserve.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                UserService service = ApiClient.getRetrofitInstance(token).create(UserService.class);

                Call<ApiResponse> call = service.reserveSession(dataList.get(position).getId());
                call.enqueue(new Callback<ApiResponse>() {



                    @Override
                    public void onResponse(Call<ApiResponse> call, Response<ApiResponse> response) {

                        Toast.makeText(context, response.body().getMessage(), Toast.LENGTH_SHORT).show();


                        if(response.body().getMessage().contains("success")) {

                            context.startActivity(new Intent(context, SessionsActivity.class).putExtra("token", token));
                            activity.finish();
                            //     Intent refresh = new Intent(context, SessionsActivity.class);
                            //                 context.startActivity(refresh);

                        }
                    }

                    @Override
                    public void onFailure(Call<ApiResponse> call, Throwable t) {

                        Toast.makeText(context, "Une erreur s'est produite... Veuillez réessayer plus tard !", Toast.LENGTH_SHORT).show();
                    }
                });


            }
        });




        holder.btn_edit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                activity.startActivity(new Intent(activity, EditSessionActivity.class).putExtra("session",dataList.get(position)));


            }
        });
    }

       /* Picasso.Builder builder = new Picasso.Builder(context);
        builder.downloader(new OkHttp3Downloader(context));
        builder.build().load(dataList.get(position).getThumbnailUrl())
                .placeholder((R.drawable.ic_launcher_background))
                .error(R.drawable.ic_launcher_background)
                .into(holder.coverImage);
*/


    @Override
    public int getItemCount() {
        return dataList.size();
    }
}
