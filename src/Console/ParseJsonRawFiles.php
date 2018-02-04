<?php

namespace Daison\BusRouterSg\Console;

use Daison\BusRouterSg\Models;
use Illuminate\Console\Command;

class ParseJsonRawFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bus-router-sg:parse-json';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse all related json files.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach ($this->getBuses() as $bus) {
            try {
                Models\Bus::where('bus_number', $bus)->firstOrFail();

                continue;
            } catch (\Throwable $e) {
                // do nothing...
            }

            Models\Bus::create($bus);
        }

        foreach ($this->getBusServices() as $service) {
            try {
                Models\BusService::where('bus_id', $service['bus_id'])->firstOrFail();

                continue;
            } catch (\Throwable $e) {
                // do nothing...
            }

            Models\BusService::create($service);
        }

        foreach ($this->getBusStops() as $busStop) {
            try {
                Models\BusStop::where('bus_station_code', $busStop['bus_station_code'])->firstOrFail();

                continue;
            } catch (\Throwable $e) {
                // do nothing
            }

            Models\BusStop::create($busStop);
        }

        foreach ($this->getBusStopServices() as $busStopService) {
            try {
                Models\BusStopService::where('bus_stop_id', $busStopService['bus_stop_id'])
                    ->where('bus_id', $busStopService['bus_id'])
                    ->firstOrFail();

                continue;
            } catch (\Throwable $e) {
                // do nothing
            }

            Models\BusStopService::create($busStopService);
        }

        foreach ($this->getBusRoutes() as $busRoute) {
            try {
                Models\BusRoute::where('bus_stop_id', $busRoute['bus_stop_id'])
                    ->where('bus_id', $busRoute['bus_id'])
                    ->firstOrFail();

                continue;
            } catch (\Throwable $e) {
                // do nothing
            }

            Models\BusRoute::create($busRoute);
        }
    }

    protected function toArray($json)
    {
        return json_decode($json, true);
    }

    protected function getBusStopServices()
    {
        $this->comment('Parsing bus-stops-services.json');

        $contents = $this->toArray(file_get_contents(__DIR__.'/raw/bus-stops-services.json'));

        $ret = [];

        foreach ($contents as $busStationCode => $buses) {
            foreach ($buses as $bus) {
                $tmp = [];

                $tmp['bus_stop_id'] = Models\BusStop::where('bus_station_code', $busStationCode)->first()->id;
                $tmp['bus_id'] = Models\Bus::where('bus_number', $bus)->first()->id;

                $ret[] = $tmp;
            }
        }

        return $ret;
    }

    protected function getBusStops()
    {
        $this->comment('Parsing bus-stops.json');

        $contents = $this->toArray(file_get_contents(__DIR__.'/raw/bus-stops.json'));

        $ret = [];

        foreach ($contents as $content) {
            $tmp = [];

            $tmp['bus_station_code'] = $content['no'];
            $tmp['lat'] = $content['lat'];
            $tmp['lng'] = $content['lng'];
            $tmp['name'] = $content['name'];

            $ret[] = $tmp;
        }

        return $ret;
    }

    protected function getBusServices()
    {
        $this->comment('Parsing bus-services.json');

        $contents = $this->toArray(file_get_contents(__DIR__.'/raw/bus-services.json'));

        $ret = [];

        foreach ($contents['services'] as $content) {
            $type =
                ($content['type'] === '0') ? Models\BusService::TYPE_TRUNK :
                ($content['type'] === '1') ? Models\BusService::TYPE_FEEDER :
                ($content['type'] === '2') ? Models\BusService::TYPE_NITE :
                null;

            if (! $type) {
                throw new \Exception('Bus service type undefined.');
            }

            $tmp = [
                'type' => $type,
                'bus_id' => Models\Bus::where('bus_number', $content['no'])->first()->id,
                'routes' => $content['routes'],
                'operator' => $content['operator'] ?: '',
                'name' => $content['name'],
            ];

            $ret[] = $tmp;
        }

        return $ret;
    }

    private function getBusFiles()
    {
        $dir = new \RecursiveDirectoryIterator(__DIR__.'/raw/bus-services/');

        return new \RecursiveIteratorIterator($dir, \RecursiveDirectoryIterator::SKIP_DOTS);
    }

    protected function getBuses()
    {
        $this->comment('Parsing lists of buses from bus-services/*');

        $buses = [];

        foreach ($this->getBusFiles() as $file) {
            $buses[] = [
                'bus_number' => str_replace('.json', '', $file->getFilename())
            ];
        }

        return $buses;
    }

    protected function getBusRoutes()
    {
        $this->comment('Parsing bus routes from bus-services/*');

        $ret = [];

        foreach ($this->getBusFiles() as $file) {
            $busNumber = str_replace('.json', '', $file->getFilename());
            $contents = $this->toArray(file_get_contents($file->getPathname()));

            if (! $contents) {
                continue;
            }

            foreach ($contents as $route => $content) {
                if (! count($content['stops'])) {
                    continue;
                }

                foreach ($content['stops'] as $busStationCode) {
                    $busStop = Models\BusStop::where('bus_station_code', $busStationCode)->first();

                    if (! $busStop) {
                        continue;
                    }

                    $ret[] = [
                        'route' => $route,
                        'bus_id' => Models\Bus::where('bus_number', $busNumber)->first()->id,
                        'bus_stop_id' => $busStop->id,
                    ];
                }
            }
        }

        return $ret;
    }
}
