<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cpd;use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;
use Dompdf\Options;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Writer;

class CpdsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, ) {

        $cpds = Cpd::query();

        if(!empty($request->search)) {
            $cpds->where('code', 'like', '%' . $request->search . '%');
        }

        $cpds = $cpds->get();


        return view('admin.cpds.index', compact('cpds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        return view('admin.cpds.create', []);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ) {

        $request->validate(["code" => "required", "topic" => "required", "content" => "required", "hours" => "required", "target_group" => "required", "location" => "required", "start_date" => "required", "end_date" => "required", "resource" => "required", "status" => "required"]);

        try {

            $cpd = new Cpd();

            if ($request->hasFile('resource')) {
                $file =  $request->file('resource');
                $extension = $file->extension();

                $filename = time().rand(100,1000).'.'.$extension;

                $storage = \Storage::disk('public')->putFileAs(
                    'attachments/',
                    $file,
                    $filename
                );

                if (!$storage) {
                    return redirect()->back()->with('error','Unable to upload resource');
                }

                $cpd->resource = $filename;
            }

            if ($request->hasFile('banner')) {
                $file =  $request->file('banner');
                $extension = $file->extension();

                $filename = time().rand(100,1000).'.'.$extension;

                $storage = \Storage::disk('public')->putFileAs(
                    'banners/',
                    $file,
                    $filename
                );

                if (!$storage) {
                    return redirect()->back()->with('error','Unable to upload banner');
                }

                $cpd->banner = $filename;
            }
            $cpd->code = $request->code;
            $cpd->topic = $request->topic;
            $cpd->content = $request->content;
            $cpd->hours = $request->hours;
            $cpd->points = $request->points;
            $cpd->target_group = $request->target_group;
            $cpd->location = $request->location;
            $cpd->start_date = $request->start_date;
            $cpd->end_date = $request->end_date;
            $cpd->normal_rate = str_replace(',', '', $request->normal_rate);
            $cpd->members_rate = str_replace(',', '', $request->members_rate);
            $cpd->status = $request->status;
            $cpd->type = $request->type;
            $cpd->save();

            activity()->performedOn($cpd)->log('Created CPD:'.$cpd->topic);

            return redirect('admin/cpds')->with('success', __('Cpd created successfully.'));
        } catch (\Throwable $e) {
            return redirect()->back()->withInput($request->input())->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Cpd $cpd
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Cpd $cpd,) {

        return view('admin.cpds.show', compact('cpd'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Cpd $cpd
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Cpd $cpd,) {

        return view('admin.cpds.edit', compact('cpd'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cpd $cpd,) {

        $request->validate(["code" => "required", "topic" => "required", "content" => "required", "hours" => "required", "target_group" => "required", "location" => "required", "start_date" => "required", "end_date" => "required", "points" => "required", "status" => "required"]);

        try {
            if ($request->hasFile('resource')) {
                $file =  $request->file('resource');
                $extension = $file->extension();

                $filename = time().rand(100,1000).'.'.$extension;

                $storage = \Storage::disk('public')->putFileAs(
                    'attachments/',
                    $file,
                    $filename
                );

                if (!$storage) {
                    return redirect()->back()->with('error','Unable to upload resource');
                }

                if (\Storage::disk('public')->exists('attachments/'.$cpd->resource)) {
                    \Storage::disk('public')->delete('attachments/'.$cpd->resource);
                }

                $cpd->resource = $filename;
            }

            if ($request->hasFile('banner')) {
                $file =  $request->file('banner');
                $extension = $file->extension();

                $filename = time().rand(100,1000).'.'.$extension;

                $storage = \Storage::disk('public')->putFileAs(
                    'banners/',
                    $file,
                    $filename
                );

                if (!$storage) {
                    return redirect()->back()->with('error','Unable to upload banners');
                }

                if (\Storage::disk('public')->exists('banners/'.$cpd->resource)) {
                    \Storage::disk('public')->delete('banners/'.$cpd->resource);
                }

                $cpd->banner = $filename;
            }

            $cpd->code = $request->code;
            $cpd->topic = $request->topic;
            $cpd->content = $request->content;
            $cpd->hours = $request->hours;
            $cpd->points = $request->points;
            $cpd->target_group = $request->target_group;
            $cpd->location = $request->location;
            $cpd->start_date = $request->start_date;
            $cpd->end_date = $request->end_date;
            $cpd->normal_rate = str_replace(',','',$request->normal_rate);
            $cpd->members_rate = str_replace(',', '', $request->members_rate);
            $cpd->status = $request->status;
            $cpd->type = $request->type;
            $cpd->save();

            activity()->performedOn($cpd)->log('edited CPD:'.$cpd->topic);

            return redirect()->route('cpds.index', [])->with('success', __('Cpd edited successfully.'));
        } catch (\Throwable $e) {
            return redirect()->route('cpds.edit', compact('cpd'))->withInput($request->input())->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Cpd $cpd
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cpd $cpd,) {

        try {
            $cpd->delete();

            activity()->performedOn($cpd)->log('deleted CPD:'.$cpd->topic);

            return redirect()->route('cpds.index', [])->with('success', __('Cpd deleted successfully'));
        } catch (\Throwable $e) {
            return redirect()->route('cpds.index', [])->with('error', 'Cannot delete Cpd: ' . $e->getMessage());
        }
    }

    public function attendence($attendence_id,$status)
    {
        try {
            $attendence = \App\Models\Attendence::find($attendence_id);
            \DB::beginTransaction();

            $attendence->status = $status;
            $attendence->save();


            if ($status == "Attended") {
                if ($attendence->cpd->points > 0) {
                    $user = \App\Models\User::find($attendence->user_id);

                    $user->points +=$attendence->cpd->points;
                    $user->save();

                    $points = new \App\Models\Point;
                    $points->type = "CPD";
                    $points->user_id = $user->id;
                    $points->points = $attendence->cpd->points;
                    $points->awarded_by = \Auth::user()->id;
                    $points->save();

                    $rate = ($user->subscribed == 1) ? $attendence->cpd->members_rate : $attendence->cpd->normal_rate;

                    if ($rate > 0) {
                        $payment = new \App\Models\Payment;
                        $payment->type = "CPD";
                        $payment->amount = $rate;
                        $payment->balance = 0;
                        $payment->user_id = $user->id;
                        $payment->received_by = \Auth::user()->id;
                        $payment->cpd_id = $attendence->cpd->id;
                        $payment->save();
                    }

                    activity()->performedOn($attendence->cpd)->log('Approved '.$user->name.' CPD attendence - '.$attendence->cpd->topic);
                }
            }else{
                activity()->performedOn($attendence->cpd)->log('booked '.$attendence->user->name.' CPD attendence - '.$attendence->cpd->topic);
            }
            \DB::commit();

            return redirect()->back()->with('success','Attendence has been updated successfully');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    public function generate_qr($type,$id)
    {
        $url = config('app.url')."/direct_attendence/".$type."/".$id;
             
        $options = new Options();
        $options->set('defaultFont', 'Courier');
        $options->set('isRemoteEnabled', true);
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        $renderer = new ImageRenderer(
            new \BaconQrCode\Renderer\RendererStyle\RendererStyle(100),
            new \BaconQrCode\Renderer\Image\SvgImageBackEnd()
        );
        $writer = new Writer($renderer);
        $qrCode = $writer->writeString($url);


        // $qrCode = QrCode::format('png')->size(200)->generate($data);

        $dompdf = new Dompdf($options);
        $view = View::make('members.attendence.qrcode', compact('qrCode'))->render();
        
        $dompdf->loadHtml($view);

        // Render the HTML as PDF
        $dompdf->render();
        $dompdf->stream('attendence code.pdf');
    }

    public function payment_proof($name)
    {
        return view('admin.cpds.payment_proof',compact('name'));
    }
}
