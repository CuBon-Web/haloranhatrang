import { HTTP } from '../../core/plugins/http';

export const listItinerary = ({ commit }, opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/website/itinerary/list', opt || {}).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        });
    });
};

export const saveItinerary = ({ commit }, opt) => {
    return new Promise((resolve, reject) => {
        HTTP.post('/api/website/itinerary/create', opt).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        });
    });
};

export const detailItinerary = ({ commit }, opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/website/itinerary/edit/' + opt.id).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        });
    });
};

export const deleteItinerary = ({ commit }, opt) => {
    return new Promise((resolve, reject) => {
        HTTP.get('/api/website/itinerary/delete/' + opt.id).then(response => {
            return resolve(response.data);
        }).catch(error => {
            return reject(error);
        });
    });
};
